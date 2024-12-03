<?php

namespace App\Http\Livewire\Contractor;

use Livewire\Component;
use App\Models\ProjectApplication;
use App\Models\ProjectApplicationDocument;
use Illuminate\Support\Facades\Auth;
use Livewire\WithFileUploads;
use Carbon\Carbon;

class DocumentsComponent extends Component
{

    public $doc_file;
    public $doc_name;
    public $project;
    use WithFileUploads;

    public function uploadDocument(){
        $this->validate([
            // 'doc_name' =>['required','string','unique:project_application_documents,document_name'],
            // 'doc_file' =>['required','file'],
            'doc_name' =>['required','string'],
            'doc_file' => 'required|file|mimes:pdf,doc,docx,jpg,png|max:10240',
            'project' => 'required',
        ]);


        $documentName = Carbon::now()->timestamp. '.' . $this->doc_file->getClientOriginalName();
        $this->doc_file->storeAs('documents',$documentName);

        ProjectApplicationDocument::create([
            'project_application_id' => $this->project,
            'user_id' =>Auth::user()->id,
            'document_name' => $this->doc_name,
            'document' => $documentName
        ]);

        $this->reset();

        $this->dispatchBrowserEvent('success',['success' => 'Document Successfully Uploaded']);
    }

    public function downloadFile($document)
    {
        // foreach ($this->selApplicant->documents  as $applicationDocument){

        // }
            $filePath = public_path('assets/documents/documents/' . $document);
            
            if (file_exists($filePath)) {
                return response()->download($filePath, $document);
            } else {
                $this->dispatchBrowserEvent('error',["error" =>"Document not found!."]);
            }
        
    }

    public function render()
    {
        $applications = ProjectApplication::where('user_id',Auth::user()->id)->get();
        $documents = ProjectApplicationDocument::where('user_id',Auth::user()->id)->orderBy('created_at','desc')->get();
        return view('livewire.contractor.documents-component',compact('documents','applications'))->layout('layouts.contractor');
    }
}
