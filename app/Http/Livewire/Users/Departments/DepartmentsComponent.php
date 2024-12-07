<?php

namespace App\Http\Livewire\Users\Departments;

use Livewire\Component;
use App\Models\Department;
use Livewire\WithPagination;

class DepartmentsComponent extends Component
{
    protected $listeners = ['delete-confirmed'=>'deleteDepartment']; // listen to comfirmatio delete and call delete branch function

    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $actionId;
    public $paginate;
    public $department;
    public $category;

    public function deleteDepartment(){

        Department::find($this->actionId)->delete();
        $this->dispatchBrowserEvent('success',['success'=>'Department Successfully Deleted']);
    }

    public function setActionId($id){
        $this->actionId = $id;
    }


    public function newDepartment(){
        $this->validate([
            'department' => ['required','string','unique:departments,name'],
            'category' => ['required','string']
        ]);

        Department::create([
            'category' => $this->category,
            'name' => $this->department
        ]);

        $this->reset();
        $this->dispatchBrowserEvent('success',['success'=>'Department Successfully Created']);

    }
    public $searchTerm = null;
    public $searchBy = null;

    public function mount(){
    $this->searchBy = 'name'; //set default search criterial
    $this->paginate = 10; //set default search criterial
    }

    //get branch records
    public function getDepartments(){
        $departments = Department::query()
        ->where($this->searchBy, 'like', '%'.$this->searchTerm.'%')
        ->latest()->paginate($this->paginate);
        return $departments;
    }

    public function render()
    {
        $departments = $this->getDepartments();
        return view('livewire.users.departments.departments-component',compact('departments'));
    }
}
