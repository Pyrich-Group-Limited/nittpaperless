<?php

namespace App\Http\Livewire\Employees;

use Livewire\Component;
use App\Models\Hrmdocument;
use App\Models\Hrmfolder;
use App\Models\User;
use Livewire\WithPagination;

class EmployeeSelectedFolderComponent extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';
    public $searchTerm = null;
    public $paginate;
    public $folder_id;
    public $folder;

    public function mount($id){
        $this->folder_id =  $id;
        $this->folder = Hrmfolder::find($id);
    }

    public function getFolders(){
        $folders = Hrmdocument::query()
            ->where(function($query) {
            if($this->searchTerm) {
                $query->where('file_name', 'like', '%'.$this->searchTerm.'%' );
            }
        })->where('hrmfolders_id',$this->folder_id)
        ->latest()->paginate($this->paginate);
        return $folders;
    }
    public function render()
    {
        $documents = $this->getFolders();
        return view('livewire.employees.employee-selected-folder-component',compact('documents'));
    }
}
