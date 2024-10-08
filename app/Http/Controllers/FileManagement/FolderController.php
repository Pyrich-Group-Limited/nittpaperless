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
                $folders = Folder::where('user_id',Auth::user()->id)->orderBy('created_at', 'desc')->paginate(10);
            } else {
                $folders = Folder::where('user_id',Auth::user()->id)->orderBy('created_at', 'asc')->paginate(10);
            }
        }

        return view('filemanagement.folders', compact('folders','sortOrder'));

    }

    public function store(Request $request)
    {
        $request->validate(['name' => 'required|string|max:255']);
        Folder::create([
            'folder_name' => $request->name,
            'user_id' => Auth::id(),
        ]);

        return redirect()->back()->with('success', 'Folder created successfully.');
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
