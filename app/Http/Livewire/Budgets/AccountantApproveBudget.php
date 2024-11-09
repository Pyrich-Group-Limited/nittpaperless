<?php

namespace App\Http\Livewire\Budgets;

use Livewire\Component;
use App\Models\DepartmentBudget;
use App\Models\BudgetCategory;
use Illuminate\Support\Facades\Auth;

class AccountantApproveBudget extends Component
{
    // public $departmentBudgets;
    public $budget;
    public $selBudget;
    // public $budgetId;
    public $comment = '';
    public $selectedBudgetId;

    public $showDetails = null;

    public function mount()
    {
        if(Auth::user()->type=='DG'){
            $this->departmentBudgets = DepartmentBudget::where('status', 'pending_dg_approval')
            ->with('budgetCategory', 'items')
                ->orderBy('created_at', 'desc')
                ->get();
        }else{
            // $this->departmentBudgets = DepartmentBudget::where('department_id', auth()->user()->department_id)
            $this->departmentBudgets = DepartmentBudget::
            // ->where('status', 'pending')     
            with('budgetCategory', 'items')
                ->orderBy('created_at', 'desc')
                ->get();
        }
    }

    public function toggleDetails($budgetId)
    {
        $this->showDetails = $this->showDetails == $budgetId ? null : $budgetId;
    }

    public function setBudget(DepartmentBudget $budget){
        $this->selBudget = $budget;
    }

    public function approveBudget($budgetId)
    {
        $budget = DepartmentBudget::find($budgetId);

        // Check if the budget is already approved
            if ($budget->status === 'approved') {
                $this->dispatchBrowserEvent('error',["error" =>"This budget has already been approved."]);
                return;
            }
        $category = BudgetCategory::find($budget->budget_category_id);

        if ($category->remaining_amount >= $budget->total_requested) {

            $category->remaining_amount -= $budget->total_requested;
            $category->deficit = 0;
           
        } else {
            $neededAmount = $budget->total_requested - $category->remaining_amount;

                $budget->total_requested -= $category->remaining_amount;
                $category->remaining_amount = 0;

            $category->deficit += $neededAmount;
        }

            $category->save();

             $budget->status = 'approved';
             $budget->save();
             $this->dispatchBrowserEvent('success',["success" =>"Budget successfully approved."]);
        
    }

    public function markPendingDgApproval($budgetId)
    {
        $budget = DepartmentBudget::find($budgetId);

        // Ensure the budget is currently in the "approved" status by the accountant
        if ($budget && $budget->status === 'pending') {
            // Set the status to pending DG approval
            $budget->status = 'pending_dg_approval';
            $budget->save();

            $this->dispatchBrowserEvent('success', ["success" => "Budget forwarded for DG approval."]);
        // } else {
        //     $this->dispatchBrowserEvent('error', ["error" => "The budget must be approved by the accountant first."]);
        }
    }

    // Method to reject a budget
    public function rejectBudget($budgetId)
    {
        $budget = DepartmentBudget::find($budgetId);

        if ($budget && $budget->status === 'pending' || $budget && $budget->status === 'pending_dg_approval') {
            // Update status to rejected and save the comment
            $budget->status = 'rejected';
            $budget->comment = $this->comment;
            $budget->save();

            // Clear the comment and reload budgets
            $this->comment = '';
            $this->dispatchBrowserEvent('success', ['success' => 'Budget rejected with comment.']);
            $this->mount(); // Reload pending budgets
        }
    }

    public function render()
    {
        // if(Auth::user()->type=='DG'){
        //     $departmentBudgets = DepartmentBudget::where('status', 'pending_dg_approval')->get();
        // }else{
        //     $departmentBudgets = DepartmentBudget::where('status', 'pending')->get();
        // }
        return view('livewire.budgets.accountant-approve-budget');
    }
}
