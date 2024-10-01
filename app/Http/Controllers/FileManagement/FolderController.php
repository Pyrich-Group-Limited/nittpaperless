<?php

namespace App\Http\Controllers\FileManagement;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\File;
use App\Models\Folder;

class FolderController extends Controller
{
    public function index()
    {
        $folders = Folder::where('user_id',Auth::user()->id)->get();
        return view('filemanagement.folders', compact('folders'));

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

    public function rename(Folder $folder, Request $request)
    {
        $this->authorize('update', $folder);
        $request->validate(['name' => 'required|string|max:255']);
        $folder->update(['folder_name' => $request->name]);

        return redirect()->back()->with('success', 'Folder renamed successfully.');
    }
}
