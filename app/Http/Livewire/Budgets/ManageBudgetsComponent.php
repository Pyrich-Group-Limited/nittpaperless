<?php

namespace App\Http\Livewire\Budgets;

use Livewire\Component;
use App\Models\BudgetCategory;

class ManageBudgetsComponent extends Component
{
    public $categories;
    public $name;
    public $total_amount;

    public function mount()
    {
        $this->categories = BudgetCategory::all();
    }

    public function createBudgetCategory()
    {
        $this->validate([
            'name' => 'required|string',
            'total_amount' => 'required|numeric|min:0',
        ]);

        BudgetCategory::create([
            'name' => $this->name,
            'total_amount' => $this->total_amount,
            'remaining_amount' => $this->total_amount,
        ]);
        $this->dispatchBrowserEvent('success',["success" =>"Budget category created successfully."]);

        $this->reset(['name', 'total_amount']);
        $this->categories = BudgetCategory::all();
    }

    public function destroy(BudgetCategory $category)
    {
        if(\Auth::user()->can('delete appraisal'))
        {
                $category->delete();
                return redirect()->route('budget.category')->with('success', __('Budget Category successfully deleted.'));
        }
        else
        {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }

    public function render()
    {
        // $categories = BudgetCategory::all();
        return view('livewire.budgets.manage-budgets-component');
    }
}
