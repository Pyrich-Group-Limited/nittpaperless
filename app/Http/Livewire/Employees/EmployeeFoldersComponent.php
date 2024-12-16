<?php

namespace App\Http\Livewire\Employees;

use Livewire\Component;
use App\Models\Hrmfolder;
use App\Models\User;
use Livewire\WithPagination;

class EmployeeFoldersComponent extends Component
{
    use WithPagination;
    protected $listeners = ['delete-confirmed'=>'deleteFolder']; // listen to comfirmatio delete and call delete branch function

    protected $paginationTheme = 'bootstrap';
    public $searchTerm = null;
    public $paginate;
    public $user_id;
    public $folder_type;
    public $folder_name;
    public $selFolder;

    public function mount($id,$type){
        $this->user_id =  $id;
        $this->folder_type =  $type;
    }

    public function setActionId($id){
        $this->actionId = $id;
    }

    public function deleteFolder(){

        Hrmfolder::find($this->actionId)->delete();
        $this->dispatchBrowserEvent('success',['success'=>'Folder Successfully Deleted']);
    }


    public function createFile(){
        $this->validate([
            'folder_name' => ['required','string'],
        ]);

        Hrmfolder::create([
            'folder_name' => $this->folder_name,
            'user_id' => $this->user_id,
            'folder_type' => $this->folder_type,
        ]);

        $this->dispatchBrowserEvent('success',["success" =>"File successfully created"]);

    }


    public function renameFolderModal(HrmFolder $folder){
        $this->selFolder = $folder;
        $this->folder_name = $folder->folder_name;
    }


    public function renameFile(){

        $this->validate([
            'file_name' => ['required','string'],
        ]);

        $this->selFile->update([
            'file_name' => $this->file_name,
        ]);

        $this->dispatchBrowserEvent('success',['success'=>'File Successfully Renamed']);

    }

    public function renameFolder(){

        $this->validate([
            'folder_name' => ['required','string'],
        ]);

        $this->selFolder->update([
            'folder_name' => $this->folder_name,
        ]);

        $this->dispatchBrowserEvent('success',['success'=>'Folder Successfully Renamed']);

    }

    public function getFolders(){
        $folders = Hrmfolder::query()
            ->where(function($query) {
            if($this->searchTerm) {
                $query->where('folder_name', 'like', '%'.$this->searchTerm.'%' );
            }
        })->where('user_id',$this->user_id)->where('folder_type',$this->folder_type)
        ->latest()->paginate($this->paginate);
        return $folders;
    }
    public function render()
    {
        $folders = $this->getFolders();
        return view('livewire.employees.employee-folders-component',compact('folders'));
    }
}
