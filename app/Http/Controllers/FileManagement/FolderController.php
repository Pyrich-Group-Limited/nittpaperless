<?php

namespace App\Http\Controllers\FileManagement;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\File;
use App\Models\Folder;

class FolderController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->query('search');
        // Check if search query is present
        if ($search) {
            // If a search query exists, filter folders by the search term
            $folders = Folder::where('folder_name', 'LIKE', "%{$search}%")
            ->where('user_id',Auth::user()->id)
            ->orderBy('created_at', 'desc')
            ->paginate(10); // You can adjust the pagination limit
        } else {
            $sortOrder = $request->get('sort', 'newest');
            if ($sortOrder === 'newest') {
                $folders = Folder::where('user_id',Auth::user()->id)->where('parent_id',null)
                ->orderBy('created_at', 'desc')->paginate(10);
            } else {
                $folders = Folder::where('user_id',Auth::user()->id)->where('parent_id',null)
                ->orderBy('created_at', 'asc')->paginate(10);
            }
        }

        return view('filemanagement.folders', compact('folders','sortOrder'));

    }

    public function createFolderModal(){
        // $folders = Folder::where('user_id',Auth::user()->id)->orderBy('created_at', 'asc')->get();
        $folders = Folder::where('user_id',Auth::user()->id)->get();
        return view('filemanagement.modals.create-folder',compact('folders'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'parent_id' => 'nullable|exists:folders,id',
        ]);

        // Check if the folder is already at the 3rd level
        $parentFolder = Folder::find($request->parent_id);
        if ($parentFolder && $parentFolder->parent && $parentFolder->parent->parent) {
            return redirect()->back()->with('error', 'You cannot create more than 3 layers of folders.');
        }

        Folder::create([
            'folder_name' => $request->name,
            'user_id' => Auth::id(),
            'parent_id' => $request->parent_id,
        ]);

        return redirect()->back()->with('success', 'Folder created successfully.');
    }

    public function move(Request $request)
    {
        $request->validate([
            'dragged_folder_id' => 'required|exists:folders,id',
            'target_folder_id' => 'required|exists:folders,id',
        ]);

        $draggedFolder = Folder::find($request->dragged_folder_id);
        $targetFolder = Folder::find($request->target_folder_id);

        // Prevent circular references or moving into unrelated folders
        if ($draggedFolder->id === $targetFolder->id) {
            // return redirect()->back()->with('error', 'Cannot move folder into itself.');
            return response()->json(['success' => false, 'message' => 'Cannot move folder into itself.']);
        }

        // Update the parent folder relationship
        $draggedFolder->parent_id = $targetFolder->id;
        $draggedFolder->save();

        // return redirect()->back()->with('success', 'Folder moved successfully!');
        return response()->json(['success' => true, 'success' => 'Folder moved successfully!']);
    }


     //raname folder modal display
     public function renameFolderModal($id){
        $folder = Folder::find($id);
        return view('filemanagement.modals.rename-folder',compact('folder'));
    }

    public function rename(Folder $folder, Request $request)
    {
        // $this->authorize('update', $folder);
        $request->validate(['name' => 'required|string|max:255']);
        $folder->update(['folder_name' => $request->name]);

        return redirect()->back()->with('success', 'Folder renamed successfully.');
    }

    public function show(Folder $folder){
        // $files = $folder->files;  // Get all files in the folder
        $files = $folder->files()->simplePaginate(12);
        return view('filemanagement.show-folder',compact('folder', 'files'));
    }
}
