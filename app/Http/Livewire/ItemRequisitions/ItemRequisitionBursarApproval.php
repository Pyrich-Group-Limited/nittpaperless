<?php

namespace App\Http\Livewire\ItemRequisitions;

use Livewire\Component;
use App\Models\ItemRequisitionRequest;
use App\Models\ItemRequisitionList;
use App\Models\ItemRequisitionApproval;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ItemRequisitionBursarApproval extends Component
{
    public $departments;
    public $selectedDepartment = null;
    public $requisitions = [];
    public $selectedRequisition = null;
    public $comments;
    public $secretCode;
    public $showSecretCodeModal = false;

    protected $rules = [
        'selectedRequisition' => 'nullable|exists:item_requisition_requests,id',
        'comments' => 'nullable|string',
    ];

    public function mount()
    {
        $this->loadDepartments();
    }

    public function loadDepartments()
    {
        // Group only requisitions with statuses 'hod_approved' and 'special_duty_head_approved'
        $this->departments = ItemRequisitionRequest::whereIn('status', ['hod_approved', 'special_duty_head_approved','bursar_approved'])
            ->whereHas('department')
            ->with('department')
            ->get()
            ->groupBy('department.name')
            ->map(function ($group) {
                return ['count' => $group->count()];
            });
    }

    public function selectDepartment($departmentName)
    {
        $this->selectedDepartment = $departmentName;

        // Fetch requisitions for the selected department with specified statuses
        $this->requisitions = ItemRequisitionRequest::whereIn('status', ['hod_approved', 'special_duty_head_approved','bursar_approved'])
            ->whereHas('department', function ($query) use ($departmentName) {
                $query->where('name', $departmentName);
            })
            ->where(function ($query) {
                //fetch those approved or yet to be approved by the current user
                $query->whereDoesntHave('approvals', function ($subQuery) {
                    $subQuery->where('approved_by', auth()->id())
                            ->where('role', auth()->user()->type);
                })
                ->orWhereHas('approvals', function ($subQuery) {
                    $subQuery->where('approved_by', auth()->id())
                            ->where('role', auth()->user()->type);
                });
            })
            ->with(['items', 'approvals'])
            ->orderBy('created_at', 'desc')
            ->get();
    }


    public function selectRequisition($id)
    {
        $this->selectedRequisition = ItemRequisitionRequest::with('items')->find($id);
        $this->comments = null;
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
            'comments' => 'nullable|string',
            'secretCode' => 'required',
        ]);

        $approverId = User::where('type', '!=', 'super admin')->where('type', '!=', 'DG')
            ->whereHas('permissions', function ($query) {
                $query->where('name', 'store approve SRN');
            })->first();

        if (!$approverId) {
            $this->dispatchBrowserEvent('error',["error" =>"No next approver found with the 'bursar approval' permission"]);
            return;
        }

        if (!Hash::check($this->secretCode, Auth::user()->secret_code)) {
            $this->dispatchBrowserEvent('error',["error" =>"The secret code is incorrect !"]);
            return;
        }

        $this->selectedRequisition->update(['status' => 'bursar_approved']);

        if ($approverId) {
            createNotification(
                $approverId->id,
                'Item Requsition Approval Request',
                'A new Requsition by '. Auth::user()->name.' requires your approval.',
                route('itemRequisition.storeApproval'),
            );
        }

        $this->reset();
        // $this->reset(['secretCode', 'comments', 'selectedRequisition']);
        $this->mount();
        $this->dispatchBrowserEvent('success', ['success' => 'Requisition approved successfully.']);
    }

    public function rejectRequisition()
    {
        if (!$this->selectedRequisition) {
            $this->dispatchBrowserEvent('error', ['error' => 'No requisition selected.']);
            return;
        }
        $this->selectedRequisition->update(['status' => 'rejected']);

        $this->dispatchBrowserEvent('success', ['message' => 'Requisition rejected successfully.']);
        $this->mount();
        // $this->loadDepartments();
        // $this->requisitions = [];
        // $this->selectedRequisition = null;
    }

    public function render()
    {
        return view('livewire.item-requisitions.item-requisition-bursar-approval');
    }
}
