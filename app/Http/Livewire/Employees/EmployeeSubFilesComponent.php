<?php

namespace App\Http\Livewire\Employees;

use Livewire\Component;
use App\Models\Hrmfolder;
use App\Models\User;
use Livewire\WithPagination;

class EmployeeSubFilesComponent extends Component
{

    use WithPagination;

    protected $paginationTheme = 'bootstrap';
    public $searchTerm = null;
    public $paginate;
    public $user_id;

    public function mount($id){
        $this->user_id =  $id;
    }

    public function getFolders(){
        $folders = Hrmfolder::query()
            ->where(function($query) {
            if($this->searchTerm) {
                $query->where('folder_name', 'like', '%'.$this->searchTerm.'%' );
            }
        })->where('user_id',$this->user_id)
        ->groupBy('folder_type')

        ->latest()->paginate($this->paginate);
        return $folders;
    }
    public function render()
    {
        $folders = $this->getFolders();
        return view('livewire.employees.employee-sub-files-component',compact('folders'));
    }
}
