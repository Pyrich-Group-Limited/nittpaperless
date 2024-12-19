<?php

namespace App\Http\Livewire\ItemRequisitions;

use Livewire\Component;
use App\Models\ItemRequisitionRequest;
use App\Models\ItemRequisitionList;
use App\Models\ItemRequisitionApproval;
use Illuminate\Support\Facades\Auth;

class ItemRequisitionBursarApproval extends Component
{
    public $departments;
    public $selectedDepartment = null;
    public $requisitions = [];
    public $selectedRequisition = null;
    public $comments;

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

    // public function selectDepartment($departmentName)
    // {
    //     $this->selectedDepartment = $departmentName;

    //     // Fetch requisitions with statuses hod_approved, special_duty_head_approved, or bursar_approved and beyond
    //     $this->requisitions = ItemRequisitionRequest::whereHas('department', function ($query) use ($departmentName) {
    //             $query->where('name', $departmentName);
    //         })
    //         ->whereIn('status', ['hod_approved', 'special_duty_head_approved', 'bursar_approved']) // Include bursar_approved
    //         ->orWhere(function ($query) {
    //             // Fetch requisitions approved by the current user with any further approval statuses
    //             $query->whereHas('approvals', function ($subQuery) {
    //                 $subQuery->where('approved_by', auth()->id());
    //             });
    //         })
    //         ->with(['items', 'approvals'])
    //         ->orderBy('created_at', 'desc')
    //         ->get();
    // }

   



    public function selectRequisition($id)
    {
        $this->selectedRequisition = ItemRequisitionRequest::with('items')->find($id);
        $this->comments = null;
    }

    public function approveRequisition()
    {
        $this->validate([
            'comments' => 'nullable|string',
        ]);

        if (!$this->selectedRequisition) {
            $this->dispatchBrowserEvent('error', ['error' => 'No requisition selected.']);
            return;
        }

        $this->selectedRequisition->update(['status' => 'bursar_approved']);

        $this->dispatchBrowserEvent('success', ['success' => 'Requisition approved successfully.']);
        $this->mount();
        // $this->requisitions = [];
        // $this->selectedRequisition = null;
    }

    public function rejectRequisition()
    {
        if (!$this->selectedRequisition) {
            $this->dispatchBrowserEvent('error', ['error' => 'No requisition selected.']);
            return;
        }
        $this->selectedRequisition->update(['status' => 'rejected']);

        $this->dispatchBrowserEvent('success', ['message' => 'Requisition rejected successfully.']);
        $this->loadDepartments();
        $this->requisitions = [];
        $this->selectedRequisition = null;
    }

    public function render()
    {
        return view('livewire.item-requisitions.item-requisition-bursar-approval');
    }
}
