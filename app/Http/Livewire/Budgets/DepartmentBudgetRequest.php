<?php

namespace App\Http\Livewire\Budgets;

use Livewire\Component;
use App\Models\BudgetCategory;
use App\Models\DepartmentBudget;
use App\Models\BudgetItem;
use Illuminate\Support\Facades\Auth;

class DepartmentBudgetRequest extends Component
{
    public $budgetCategories, $selectedCategory, $items = [];
    public $totalRequested = 0;
    public $selBudget;
    public $actionId;

    protected $listeners = ['delete-confirmed'=>'deleteDeptBudget'];

    public function mount()
    {
        // Initialize with one item input by default
        $this->items = [
            ['description' => '', 'amount' => null ]
        ];

        $this->budgetCategories = BudgetCategory::where('status', 'open')->get();

        // $this->departmentBudgets = DepartmentBudget::where('department_id', auth()->user()->department_id)
        //     ->where('user_id',Auth::user()->id)    
        //     ->with('budgetCategory', 'items')
        //     ->orderBy('created_at', 'desc')
        //     ->get();
    }

    public function setBudget(DepartmentBudget $budget){
        $this->selBudget = $budget;
    }

    public function addItem()
    {
        $this->items[] = ['description' => '', 'amount' => null ];
    }

    public function removeItem($index)
    {
        unset($this->items[$index]);
        $this->items = array_values($this->items); // Re-index the array
        $this->calculateTotal(); // Recalculate total after removing an item
    }

    public function calculateTotal()
    {
        // Validate each item as they change
        $this->validate([
            'items.*.description' => 'required|string|min:3',
            // 'items.*.amount' => 'required|numeric|min:0',
            'items.*.quantity' => 'required|integer|min:1',
            'items.*.unit_price' => 'required|numeric|min:0',

        ]);
            // Calculate the total requested amount by summing each item's total
        $this->totalRequested = collect($this->items)->reduce(function ($carry, $item) {
            return $carry + ($item['quantity'] * $item['unit_price']);
        }, 0);
    }

    

    public function submitRequest()
    {
        $this->validate([
            'selectedCategory' => 'required|exists:budget_categories,id',
            'items.*.description' => 'required|string|min:3',
            // 'items.*.amount' => 'required|numeric|min:0',
            'items.*.quantity' => 'required|integer|min:1',
            'items.*.unit_price' => 'required|numeric|min:0',
        ]);

        $departmentBudget = DepartmentBudget::create([
            'budget_category_id' => $this->selectedCategory,
            'department_id' => auth()->user()->department_id,
            'total_requested' => $this->totalRequested,
            'user_id' => Auth::user()->id,
        ]);

        foreach ($this->items as $item) {
            BudgetItem::create([
                'department_budget_id' => $departmentBudget->id,
                'description' => $item['description'],
                'quantity' => $item['quantity'],
                'unit_price' => $item['unit_price'],
                'amount' => $item['quantity'] * $item['unit_price'], // Calculate total for item
            ]);
        }
        $this->dispatchBrowserEvent('success',["success" =>"Budget created successfully."]);
        $this->reset(['items', 'selectedCategory', 'totalRequested']);
    }

    public function setActionId($actionId){
        $this->actionId = $actionId;
    }

    public function deleteDeptBudget(){
        $departmentBudget = DepartmentBudget::find($this->actionId);
        $departmentBudget->delete();
        $this->dispatchBrowserEvent('success', ['success' => "Successfully Deleted"]);
    }

    public function render()
    {
        $departmentBudgets = DepartmentBudget::where('department_id', auth()->user()->department_id)
            ->where('user_id',Auth::user()->id)
            ->with('budgetCategory', 'items')
            ->orderBy('created_at', 'desc')
            ->get();
        return view('livewire.budgets.department-budget-request',compact('departmentBudgets'));
    }
}
