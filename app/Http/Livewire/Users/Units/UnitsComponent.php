<?php

namespace App\Http\Livewire\Users\Units;

use Livewire\Component;
use App\Models\Department;
use App\Models\Unit;
use Livewire\WithPagination;

class UnitsComponent extends Component
{
    protected $listeners = ['delete-confirmed'=>'deleteUnit']; // listen to comfirmatio delete and call delete branch function

    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $actionId;
    public $paginate;
    public $department;
    public $unit;
    public $name;
    public $searchTerm = null;
    public $searchBy = null;

    public function mount(){
    $this->paginate = 10; //set default search criterial
    }
    public function deleteUnit(){

        Unit::find($this->actionId)->delete();
        $this->dispatchBrowserEvent('success',['success'=>'Unit Successfully Deleted']);
    }

    public function setActionId($id){
        $this->actionId = $id;
    }


    public function newUnit(){
        $this->validate([
            'unit' => ['required','string','unique:units,name'],
            'department' => ['required','string']
        ]);

        Unit::create([
            'name' => $this->unit,
            'department_id' => $this->department
        ]);

        $this->reset();
        $this->dispatchBrowserEvent('success',['success'=>'Unit Successfully Created']);

    }


    //get branch records
    public function getUnits(){
        $units = Unit::query()
        ->where('name', 'like', '%'.$this->searchTerm.'%')
        ->latest()->paginate($this->paginate);
        return $units;
    }

    public function render()
    {
        $units = $this->getUnits();
        return view('livewire.users.units.units-component',compact('units'));
    }
}
