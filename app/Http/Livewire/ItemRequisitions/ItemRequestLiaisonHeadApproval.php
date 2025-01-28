<?php

namespace App\Http\Livewire\ItemRequisitions;

use Livewire\Component;
use App\Models\ItemRequisitionRequest;
use App\Models\ItemRequisitionList;
use App\Models\ItemRequisitionApproval;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Department;

class ItemRequestLiaisonHeadApproval extends Component
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
        $userId = Auth::id(); // Get the currently authenticated user ID

        $query = ItemRequisitionRequest::with('items');

        if ($this->filter === 'pending') {
            $query->where('status', 'liaison_head_approval');
        } elseif ($this->filter === 'approved') {
            $query->whereHas('approvals', function ($q) use ($userId) {
                $q->where('approved_by', $userId)
                ->where('status', 'approved');
            });
        } elseif ($this->filter === 'rejected') {
            $query->where('status', 'rejected');
        } else {
            $query->where(function ($q) use ($userId) {
                $q->where('status', 'liaison_head_approval') // Pending approval
                ->orWhereHas('approvals', function ($subQuery) use ($userId) {
                    $subQuery->where('approved_by', $userId)
                            ->where('status', 'approved'); // Already approved
                });
            });
        }

        $this->itemRequisitions = $query->orderBy('created_at', 'desc')->get();
    }


    public function selectRequisition($id)
    {
        $this->selectedRequisition = ItemRequisitionRequest::with('items')->find($id);
        $this->comments = '';
    }

    public function liaisonHeadApproveRequisition()
    {
        if (!$this->selectedRequisition) {
            $this->dispatchBrowserEvent('error', ['message' => 'No requisition selected.']);
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

        $dept = Department::where('name','Special Duty Department')->first();
        $approverId = User::where('type','director')->where('department_id', $dept->id)->first();

        if (!$approverId) {
            $this->dispatchBrowserEvent('error',["error" =>"No next approver found for special duty dapartment"]);
            return;
        }

        if (!Hash::check($this->secretCode, Auth::user()->secret_code)) {
            $this->dispatchBrowserEvent('error',["error" =>"The secret code is incorrect!"]);
            return;
        }

        $this->selectedRequisition->update(['status' => 'liaison_head_approved']);

        ItemRequisitionApproval::create([
            'item_requisition_request_id' => $this->selectedRequisition->id,
            'approved_by' => Auth::id(),
            'role' => Auth::user()->type,
            'status' => 'approved',
            'comments' => $this->comments,
        ]);

        if ($approverId) {
            createNotification(
                $approverId->id,
                'Item Requsition Approval Request',
                'A new Requsition by '. Auth::user()->name.' requires your approval.',
                route('itemRequisition.hodApproval'),
            );
        }

        $this->dispatchBrowserEvent('success', ['success' => 'Requisition approved successfully.']);
        $this->loadRequisitions();
        $this->selectedRequisition = null;
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
        return view('livewire.item-requisitions.item-request-liaison-head-approval');
    }
}
