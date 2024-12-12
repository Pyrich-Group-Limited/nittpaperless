<?php

namespace App\Http\Livewire\Users\Designations;

use Livewire\Component;
use App\Models\Designation;
use Livewire\WithPagination;

class DesignationsComponent extends Component
{
    protected $listeners = ['delete-confirmed'=>'deleteDesignation']; // listen to comfirmatio delete and call delete branch function

    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $actionId;
    public $paginate;
    public $designation;

    public function deleteDesignation(){

        Designation::find($this->actionId)->delete();
        $this->dispatchBrowserEvent('success',['success'=>'Desgination Successfully Deleted']);
    }

    public function setActionId($id){
        $this->actionId = $id;
    }

    public function addDesignation(){
        $this->validate([
            'designation' => ['required','string','unique:designations,name'],
        ]);

        Designation::create([
            'name' => $this->designation
        ]);
        $this->reset();
        $this->dispatchBrowserEvent('success',['success'=>'Designation Successfully Created']);
    }

    public $searchTerm = null;
    public $searchBy = null;

    public function mount(){
    $this->searchBy = 'name'; //set default search criterial
    $this->paginate = 10; //set default search criterial
    }

    //get branch records
    public function getDesignation(){
        $designation = Designation::query()
        ->where('name', 'like', '%'.$this->searchTerm.'%')
        ->latest()->paginate($this->paginate);
        return $designation;
    }

    public function render()
    {
        $designations = $this->getDesignation();
        return view('livewire.users.designations.designations-component',compact('designations'));
    }
}
