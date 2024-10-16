<?php

namespace App\Http\Livewire\Contractor;

use Livewire\Component;
use App\Models\ProjectApplicationDocument;
use Illuminate\Support\Facades\Auth;
use Livewire\WithFileUploads;
use Carbon\Carbon;

class DocumentsComponent extends Component
{

    public $doc_file;
    public $doc_name;
    use WithFileUploads;

    public function uploadDocument(){
        $this->validate([
            'doc_name' =>['required','string','unique:project_application_documents,document_name'],
            'doc_file' =>['required','file'],
        ]);

        $imageName = Carbon::now()->timestamp. '.' . $this->doc_file->getClientOriginalName();
        $this->doc_file->storeAs('images',$imageName);

        ProjectApplicationDocument::create([
            'user_id' =>Auth::user()->id,
            'document_name' => $this->doc_name,
            'document' => $imageName
        ]);

        $this->dispatchBrowserEvent('success',['success' => 'Document Successfully Uploaded']);
    }
    public function render()
    {
        $documents = ProjectApplicationDocument::where('user_id',Auth::user()->id)->get();
        return view('livewire.contractor.documents-component',compact('documents'))->layout('layouts.contractor');
    }
}
