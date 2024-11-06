<?php

namespace App\Http\Livewire\Budgets;

use Livewire\Component;
use App\Models\BudgetCategory;
use App\Models\DepartmentBudget;
use App\Models\BudgetItem;

class DepartmentBudgetRequest extends Component
{
    public $budgetCategories, $selectedCategory, $items = [];
    public $totalRequested = 0;

    public function mount()
    {
        // Initialize with one item input by default
        $this->items = [
            ['description' => '', 'amount' => null ]
        ];

        $this->budgetCategories = BudgetCategory::where('status', 'open')->get();
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
            'items.*.amount' => 'required|numeric|min:0',
        ]);

        $this->totalRequested = array_reduce($this->items, function ($carry, $item) {
            return $carry + $item['amount'];
        }, 0);
    }

    public function submitRequest()
    {
        $this->validate([
            'selectedCategory' => 'required|exists:budget_categories,id',
            'items.*.description' => 'required|string|min:3',
            'items.*.amount' => 'required|numeric|min:0',
        ]);

        $departmentBudget = DepartmentBudget::create([
            'budget_category_id' => $this->selectedCategory,
            'department_id' => auth()->user()->department_id,
            'total_requested' => $this->totalRequested,
        ]);

        foreach ($this->items as $item) {
            BudgetItem::create([
                'department_budget_id' => $departmentBudget->id,
                'description' => $item['description'],
                'amount' => $item['amount'],
            ]);
        }
        $this->dispatchBrowserEvent('success',["success" =>"Budget created successfully."]);
        $this->reset(['items', 'selectedCategory', 'totalRequested']);
    }

    public function render()
    {
        $departmentBudgets = DepartmentBudget::where('department_id', auth()->user()->department_id)
            ->with('budgetCategory', 'items')
            ->orderBy('created_at', 'desc')
            ->get();
        return view('livewire.budgets.department-budget-request',compact('departmentBudgets'));
    }
}
