<?php

namespace App\Http\Livewire\Projects;

use Livewire\Component;
use Illuminate\Http\Request;
use App\Models\ProjectCreation;
use App\Models\ProjectComment;
use Auth;

class SharedProjectDetailsComponent extends Component
{
    public $project_id;
    public $commentText;

    public $comments;

    public function mount($id){

        $this->project_id = $id;
        $project = ProjectCreation::find($id);

        $this->loadComments(); // Load existing comments when component mounts
    }

    // Fetches all comments for the project
    public function loadComments()
    {
        // $this->comments = ProjectComment::with('hod')
        $this->comments = ProjectComment::where('project_creation_id', $this->project_id)
        ->orderBy('created_at', 'desc')->get();
    }

    // This method handles the comment submission by HoDs
    public function addComment()
    {
        // Validate the input
        $this->validate([
            'commentText' => 'required|string|max:1500',
        ]);

        // Insert the comment into the database
        ProjectComment::create([
            'project_creation_id' => $this->project_id,
            'user_id' => Auth::id(),
            'content' => $this->commentText,
        ]);

        // Clear the input field and reload comments
        $this->commentText = '';
        $this->loadComments(); // Refresh comments after adding a new one

        $this->dispatchBrowserEvent('success',["success" =>"Your comment has been added."]);
    }

    public function render()
    {
        $project = ProjectCreation::find($this->project_id);
        return view('livewire.projects.shared-project-details-component',compact('project'));
    }
}
