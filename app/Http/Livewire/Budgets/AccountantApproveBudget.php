<?php

namespace App\Http\Livewire\Budgets;

use Livewire\Component;
use App\Models\DepartmentBudget;
use App\Models\BudgetCategory;

class AccountantApproveBudget extends Component
{
    // public $departmentBudgets;
    public $budget;
    public $selBudget;
    // public $budgetId;

    public $showDetails = null;

    public function mount()
    {
        $this->departmentBudgets = DepartmentBudget::where('department_id', auth()->user()->department_id)
            ->with('budgetCategory', 'items')
            ->orderBy('created_at', 'desc')
            ->get();
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
            $category->save();

            $budget->status = 'approved';
            $budget->save();
            $this->dispatchBrowserEvent('success',["success" =>"Budget successfully approved."]);

            // $this->departmentBudgets = DepartmentBudget::where('status', 'pending')->get();
        } else {
            $this->dispatchBrowserEvent('error',["error" =>"Insufficient funds in the budget category.."]);
        }
    }

    public function render()
    {
        $departmentBudgets = DepartmentBudget::where('status', 'pending')->get();
        return view('livewire.budgets.accountant-approve-budget',compact('departmentBudgets'));
    }
}
