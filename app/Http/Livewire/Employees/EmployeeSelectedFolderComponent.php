<?php

namespace App\Http\Livewire\Employees;

use Livewire\Component;
use App\Models\Hrmdocument;
use App\Models\Hrmfolder;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use App\Models\User;
use Carbon\Carbon;

class EmployeeSelectedFolderComponent extends Component
{
    use WithPagination;
    use WithFileUploads;

    protected $paginationTheme = 'bootstrap';
    public $searchTerm = null;
    public $paginate;
    public $folder_id;
    public $folder;
    public $file_name;
    public $folder_name;
    public $file;
    public $selFile;
    public $selFolder;

    public function mount($id){
        $this->folder_id =  $id;
        $this->folder = Hrmfolder::find($id);
    }

    public function uploadDocument(){
        $this->validate([
            'file_name' => ['string','required'],
            'file' => ['required','max:5000'],
        ]);

        $fileName = Carbon::now()->timestamp. '.' . $this->file->getClientOriginalName();
        $this->file->storeAs('/uploads',$fileName);
        // $this->file->storePubliclyAs('uploads', 'public');
        $folder = HrmFolder::find($this->folder_id);

        HrmDocument::create([
            'file_name' => $this->file_name,
            'path' => $fileName,
            'user_id' => $folder->user_id,
            'hrmfolders_id' => $folder->id
        ]);

        $this->reset('file','file_name');
        $this->dispatchBrowserEvent('success',['success'=>'Folder Successfully Deleted']);

    }

    public function renameFileModal(HrmDocument $file){
        $this->selFile = $file;
        $this->file_name = $file->file_name;
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
