<?php

namespace App\Http\Livewire\ItemRequisitions;

use Livewire\Component;
use App\Models\ItemRequisitionRequest;
use App\Models\ItemRequisitionList;
use App\Models\ItemRequisitionApproval;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ItemRequisitionHodApproval extends Component
{
    public $itemRequisitions;
    public $selectedRequisition;
    public $comments;

    public $secretCode;
    public $showSecretCodeModal = false;

    public $filter = 'all';

    protected $rules = [
        'comments' => 'nullable|string',
    ];

    public function mount()
    {
        $this->loadRequisitions();
    }

    public function setFilter($filter)
    {
        $this->filter = $filter;
        $this->loadRequisitions();
    }

    public function loadRequisitions()
    {
        $user = Auth::user(); // Get the authenticated user

        $query = ItemRequisitionRequest::with('items'); // Base query

        // Check if the HOD belongs to the Special Duty department
        if ($user->department->name === 'Special Duty Department') {

            if ($this->filter === 'all') {
                $query->whereIn('status', ['liaison_head_approved', 'special_duty_head_approved']);
            } elseif ($this->filter === 'pending') {
                $query->where('status', 'liaison_head_approved'); // Not yet approved by Special Duty HoD
            } elseif ($this->filter === 'approved') {
                $query->where('status', 'special_duty_head_approved'); // Already approved by Special Duty HoD
            } elseif ($this->filter === 'rejected') {
                $query->where('status', 'rejected');
            }
        } else {
            $query->where('department_id', $user->department_id);

                if ($this->filter === 'all') {
                    $query->whereIn('status', ['pending_hod_approval', 'hod_approved', 'rejected']);
                } elseif ($this->filter === 'pending') {
                    $query->where('status', 'pending_hod_approval');
                } elseif ($this->filter === 'approved') {
                    $query->where('status', 'hod_approved');
                } elseif ($this->filter === 'rejected') {
                    $query->where('status', 'rejected');
                }
        }

        $this->itemRequisitions = $query->orderBy('created_at', 'desc')->get();
    }


    public function selectRequisition($id)
    {
        $this->selectedRequisition = ItemRequisitionRequest::with('items')->find($id);
        $this->comments = '';
    }

    public function approveRequisition()
    {
        if (!$this->selectedRequisition) {
            $this->dispatchBrowserEvent('error', ['error' => 'No requisition selected.']);
            return;
        }
        $this->showSecretCodeModal = true;
        $this->dispatchBrowserEvent('showSecretCodeModal');
    }

    public function verifyAndApprove()
    {
        $this->validate([
            'secretCode' => 'required',
        ]);

        $approverId = User::where('type', '!=', 'super admin')->where('type', '!=', 'dg')
            ->whereHas('permissions', function ($query) {
                $query->where('name', 'bursar approve SRN');
            })->first();

        if (!$approverId) {
            $this->dispatchBrowserEvent('error',["error" =>"No next approver found with the 'bursar approval' permission"]);
            return;
        }

        // Check if the secret code matches
        if (!Hash::check($this->secretCode, Auth::user()->secret_code)) {
            $this->dispatchBrowserEvent('error',["error" =>"The secret code is incorrect!"]);
            return;
        }

        $user = Auth::user();

        // Determine the new status based on the user's department
        $newStatus = ($user->department->name === 'Special Duty Department')
                        ? 'special_duty_head_approved'
                        : 'hod_approved';

        $this->selectedRequisition->update(['status' => $newStatus]);

        ItemRequisitionApproval::create([
            'item_requisition_request_id' => $this->selectedRequisition->id,
            'approved_by' => $user->id,
            'role' => $user->type,
            'status' => 'approved',
            'comments' => $this->comments,
        ]);

        if ($approverId) {
            createNotification(
                $approverId->id,
                'Item Requsition Approval Request',
                'A new Requsition by '. Auth::user()->name.' requires your approval.',
                route('itemRequisition.bursarApproval'),
            );
        }

        $this->loadRequisitions();
        $this->reset(['secretCode', 'comments', 'selectedRequisition']);
        $this->dispatchBrowserEvent('success', ['success' => 'Requisition approved successfully.']);
    }


    public function rejectRequisition()
    {
        if (!$this->selectedRequisition) {
            $this->dispatchBrowserEvent('error', ['error' => 'No requisition selected.']);
            return;
        }

        $this->selectedRequisition->update(['status' => 'rejected']);

        ItemRequisitionApproval::create([
            'item_requisition_request_id' => $this->selectedRequisition->id,
            'approved_by' => Auth::id(),
            'role' => Auth::user()->type,
            'status' => 'rejected',
            'comments' => $this->comments,
        ]);

        $this->dispatchBrowserEvent('success', ['success' => 'Requisition rejected successfully.']);
        $this->loadRequisitions();
        $this->selectedRequisition = null;
    }

    public function render()
    {
        return view('livewire.item-requisitions.item-requisition-hod-approval');
    }
}
