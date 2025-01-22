<?php

namespace App\Http\Livewire\Contractor;

use Livewire\Component;
use App\Models\ProjectAdvert;
use App\Models\ProjectApplicationDocument;
use App\Models\ProjectApplication;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Livewire\WithFileUploads;

class AdvertDetailsComponent extends Component
{
    use WithFileUploads;

    public $advert_id;
    public $inputs = [];

    protected $listeners = ['application-confirmed' => 'applyContract'];

    public function mount($id)
    {
        $this->advert_id = $id;
        $this->inputs = [['doc_name' => '', 'doc_file' => null]];
    }

    public function addInput()
    {
        $this->inputs[] = ['doc_name' => '', 'doc_file' => null];
    }

    public function removeInput($key)
    {
        unset($this->inputs[$key]);
        $this->inputs = array_values($this->inputs); // Reindex array to avoid gaps
    }

    protected $rules = [
        'inputs.*.doc_name' => 'required|string|max:255',
        'inputs.*.doc_file' => 'required|file|mimes:pdf,doc,docx,jpg,png|max:10240',
    ];

    public function applyContract()
    {
        $this->validate();

         // Save the project application
        $projectApp =  ProjectApplication::create([
            'project_id' => ProjectAdvert::find($this->advert_id)->project_id,
            'user_id' => Auth::user()->id,
            'application_status' => "Pending",
        ]);

        $uploadedDocuments = [];

        foreach ($this->inputs as $input) {
            // Ensure 'doc_file' is a valid uploaded file
            if ($input['doc_file'] instanceof \Livewire\TemporaryUploadedFile) {
                $filePath = $input['doc_file']->store('documents', 'public'); // Store file in the 'public/documents' folder

                $uploadedDocuments[] = [
                    'project_application_id' => $projectApp->id,
                    'user_id' => Auth::user()->id,
                    'document_name' => $input['doc_name'],
                    'document' => $filePath,
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            } else {
                $this->dispatchBrowserEvent('error', ['error' => "Invalid file upload for document: {$input['doc_name']}"]);
                return;
            }
        }

        // Save the project application
        ProjectApplication::create([
            'project_id' => ProjectAdvert::find($this->advert_id)->project_id,
            'user_id' => Auth::user()->id,
            'application_status' => "Pending",
        ]);

        // Save all uploaded documents
        ProjectApplicationDocument::insert($uploadedDocuments);

        $this->dispatchBrowserEvent('success', ['success' => 'Project BID successful!']);
        $this->reset('inputs'); // Reset input fields after successful submission
    }

    public function render()
    {
        $advert = ProjectAdvert::find($this->advert_id);

        return view('livewire.contractor.advert-details-component', compact('advert'))->layout('layouts.contractor');
    }
}
