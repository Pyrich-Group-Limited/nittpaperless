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
    public $selBudget;

    public $selectedYear;
    public $years = [];

    protected $listeners = ['delete-confirmed'=>'deleteBudget', 'open-confirmed'=>'openBudget', 'close-confirmed'=>'closeBudget'];

    public function mount()
    {
        $this->categories = BudgetCategory::all();
        $this->populateYears();
    }

    public function populateYears()
    {
        $currentYear = date('Y');
        $startYear = 1900;
        $endYear = 2100;

        for ($year = $startYear; $year <= $endYear; $year++) {
            $this->years[] = $year;
        }
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
        $this->dispatchBrowserEvent('success',["success" =>"Budget category created successfully."]);

        $this->reset(['name', 'total_amount','account']);
        $this->categories = BudgetCategory::all();
    }

    public function setBudget(BudgetCategory $budget){
        $this->selBudget = $budget;
        $this->name = $budget->name;
        $this->account = $budget->chartOfAccounts->id;
        $this->total_amount = $budget->total_amount;
        $this->year = $budget->year;
    }

    public function updateBudgetCategory(){
        $this->validate([
            'name' => 'required|string',
            'total_amount' => 'required|numeric|min:0',
            'year' => 'required',
            'account' => 'required'
        ]);
        $this->selBudget->update([
            'chart_of_account_id' => $this->account,
            'name' => $this->name,
            'total_amount' => $this->total_amount,
            'remaining_amount' => $this->total_amount,
            'year' => $this->year
        ]);
        
        $this->categories = BudgetCategory::all();

        $this->dispatchBrowserEvent('success',["success" =>"Budget category updated successfully."]);
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
        $category->delete();
        $this->dispatchBrowserEvent('success', ['success' => "Budget Category Successfully Deleted"]);
    }

    public function openBudget(){
        $category = BudgetCategory::find($this->actionId);
        $category->update(['status' => 'open']);
        $this->dispatchBrowserEvent('success', ['success' => "Budget marked as open"]);
    }

    public function closeBudget(){
        $category = BudgetCategory::find($this->actionId);
        $category->update(['status' => 'closed']);
        $this->dispatchBrowserEvent('success', ['success' => "Budget marked as closed"]);
    }


    public function render()
    {
        // $categories = BudgetCategory::all();
        $chartofAccounts = ChartOfAccount::all();
        return view('livewire.budgets.manage-budgets-component',compact('chartofAccounts'));
    }
}
