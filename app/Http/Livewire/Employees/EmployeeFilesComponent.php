<?php

namespace App\Http\Livewire\Employees;

use Livewire\Component;
use App\Models\Hrmfolder;
use App\Models\User;
use Livewire\WithPagination;

class EmployeeFilesComponent extends Component
{

    use WithPagination;
    protected $listeners = ['delete-confirmed'=>'deleteFolder']; // listen to comfirmatio delete and call delete branch function

    protected $paginationTheme = 'bootstrap';
    public $searchTerm = null;
    public $paginate;
    public $employee;
    public $folder_name;
    public $folder_type;

    public function mount(){
        $this->paginate = 10;
    }


    public function createFile(){
        $this->validate([
            'folder_name' => ['required','string'],
            'folder_type' => ['required','string'],
            'employee' => ['required','string'],
        ]);

        Hrmfolder::create([
            'folder_name' => $this->folder_name,
            'user_id' => $this->employee,
            'folder_type' => $this->folder_type,
        ]);

        $this->dispatchBrowserEvent('success',["success" =>"File successfully created"]);

    }

    public function setActionId($id){
        $this->actionId = $id;
    }

    public function deleteFolder(){

        Hrmfolder::find($this->actionId)->delete();
        $this->dispatchBrowserEvent('success',['success'=>'Folder Successfully Deleted']);
    }

    public function getFolders(){
        $folders = Hrmfolder::query()
            ->where(function($query) {
            if($this->searchTerm) {
                $query->where('folder_name', 'like', '%'.$this->searchTerm.'%' );
            }
        })->groupBy('user_id')

        ->latest()->paginate($this->paginate);
        return $folders;
    }
    public function render()
    {
        $users = User::all();
        $folders = $this->getFolders();
        return view('livewire.employees.employee-files-component',compact('folders','users'));
    }
}
