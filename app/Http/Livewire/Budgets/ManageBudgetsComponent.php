<?php

namespace App\Http\Livewire\Budgets;

use Livewire\Component;
use App\Models\BudgetCategory;
use App\Models\ChartOfAccount;

class ManageBudgetsComponent extends Component
{
    public $categories;
    public $name;
    public $total_amount;
    public $year;
    public $account;
    public $actionId;

    protected $listeners = ['delete-confirmed'=>'deleteBudget'];

    public function mount()
    {
        $this->categories = BudgetCategory::all();
    }

    public function createBudgetCategory()
    {
        $this->validate([
            'name' => 'required|string',
            'total_amount' => 'required|numeric|min:0',
            'year' => 'required',
            'account' => 'required'
        ]);

        $budget = BudgetCategory::create([
            'chart_of_account_id' => $this->account,
            'name' => $this->name,
            'total_amount' => $this->total_amount,
            'remaining_amount' => $this->total_amount,
            'year' => $this->year
        ]);
        // dd($budget);
        $this->dispatchBrowserEvent('success',["success" =>"Budget category created successfully."]);

        $this->reset(['name', 'total_amount','account']);
        $this->categories = BudgetCategory::all();
    }


    //set action id when the confirmation is required
    public function setActionId($actionId){
        $this->actionId = $actionId;
    }

    public function deleteBudget(){
        $category = BudgetCategory::find($this->actionId);

        // Check if the category has any associated budgets
        if ($category->departmentBudgets()->exists()) {
            $this->dispatchBrowserEvent('error', ['error' => "This category cannot be deleted because it has associated budgets."]);
            return;
        }

         // If no budgets are found, proceed with deletion
        $category->delete();
        $this->dispatchBrowserEvent('success', ['success' => "Budget Category Successfully Deleted"]);
    }

    public function render()
    {
        // $categories = BudgetCategory::all();
        $chartofAccounts = ChartOfAccount::all();
        return view('livewire.budgets.manage-budgets-component',compact('chartofAccounts'));
    }
}
