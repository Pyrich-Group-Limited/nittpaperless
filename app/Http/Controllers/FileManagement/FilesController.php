<?php

namespace App\Http\Controllers\FileManagement;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\File;
use App\Models\Folder;
use App\Models\User;
use Carbon\Carbon;

class FilesController extends Controller
{
    public function index(Request $request){


        $users = User::all();

        // Get the sorting order from the request, default to 'newest'
        $sortOrder = $request->get('sort', 'newest');
        // Build the query to fetch documents and order by creation date
        if ($sortOrder === 'newest') {
            $folders = Folder::orderBy('created_at', 'desc')->get();
        } else {
            $folders = Folder::orderBy('created_at', 'asc')->get();
        }

        $search = $request->input('search');
        // If search query exists, filter folders and files based on the search term
        if ($search) {
            $folders = Folder::where('folder_name', 'like', '%' . $search . '%')
                ->orWhereHas('files', function ($query) use ($search) {
                    $query->where('file_name', 'like', '%' . $search . '%');
                })
                ->with(['files' => function ($query) use ($search) {
                    $query->where('file_name', 'like', '%' . $search . '%');
                }])
                ->get();
        } else {
            // Fetch all folders with their associated files if no search term is provided
            $folders = Folder::where('user_id',Auth::user()->id)->with('files')->get();
        }

        // Fetch files that are not in any folder (root-level files)
        $rootFiles = Auth::user()->files()->whereNull('folder_id')->get();

        return view('filemanagement.index', compact('folders','rootFiles','users','sortOrder'));
    }

    //function for storing files
    public function store(Request $request)
    {
        $request->validate([
            'filename' => 'required|string|max:255',
            'file' => 'required|file',
            'folder_id' => 'nullable|exists:folders,id',
        ]);

        $path = $request->file('file')->store('files');

        File::create([
            'file_name' => $request->filename,
            'path' => $path,
            'user_id' => Auth::id(),
            'folder_id' => $request->folder_id,
        ]);

        return redirect()->back()->with('success', 'File uploaded successfully.');
    }


    // Method to download the file
    public function download(File $file)
    {
        // Get the file's path from the database
        $filePath = $file->path;
        // Check if the file exists in storage
        if (Storage::exists($filePath)) {
            // Return the file for download
            return Storage::download($filePath, $file->file_name);
        } else {
            // Return a 404 response if the file doesn't exist
            abort(404, 'File not found.');
        }
    }


    //share file modal display
    public function renameFileModal($id){
        $file = File::find($id);
        return view('filemanagement.modals.rename-file',compact('file'));
    }

    //function for renaming a file
    public function rename(File $file, Request $request)
    {
        $this->authorize('update', $file);
        $request->validate(['filename' => 'required|string|max:255']);
        $file->update(['file_name' => $request->filename]);

        return redirect()->back()->with('success', 'File renamed successfully.');
    }

    //share file modal display
    public function shareFileModal($id){
        $users = User::all();
        $file=File::find($id);
        return view('filemanagement.modals.share-modal',compact('users','file'));
    }

    //function for file sharing
    public function share(File $file, Request $request)
    {
        $this->authorize('update', $file);
        $request->validate(['user_id' => 'required|exists:users,id']);

        $user = User::find($request->user_id);
        $file->sharedWith()->syncWithoutDetaching($user);
        return redirect()->back()->with('success', 'File shared successfully.');
    }

    // display all the files shared by a user
    public function sharedFiles(Request $request){
        $sharedFiles = Auth::user()->sharedFiles;
        return view('filemanagement.shared-files',compact('sharedFiles'));
    }

    // Function to display all the files created in this current month
    public function thisMonthFiles(Request $request){

          // Get the current month and year using Carbon
        $currentMonth = Carbon::now()->month;
        $currentYear = Carbon::now()->year;

        // Get files created by the authenticated user this month
        $thisMonthfiles = Auth::user()->files()
                    ->whereMonth('created_at', $currentMonth)
                    ->whereYear('created_at', $currentYear)
                    ->get();

        return view('filemanagement.this-month-files',compact('thisMonthfiles'));
    }


    //Display the list of recent files created (within the last 7 days)
    public function newFiles(){

        // Get the current date and subtract 7 days to get the recent time frame
        $sevenDaysAgo = Carbon::now()->subDays(7);

        // Get recent files created by the authenticated user
        $newFiles = Auth::user()->files()
                    ->where('created_at', '>=', $sevenDaysAgo)
                    ->orderBy('created_at', 'desc')
                    ->get();
        return view('filemanagement.new-files',compact('newFiles'));
    }


    // Archive a file
    public function archive(File $file)
    {
        // Check if the file is already archived
        if ($file->is_archived) {
            // Return an error response if the file is already archived
            return redirect()->back()->with('error', 'This file is already archived.');
        }

        // Mark the file as archived
        $file->is_archived = 1;
        $file->save();

        return redirect()->back()->with('success', 'File archived successfully.');
    }

    // List all archived files
    public function archived()
    {
        // Fetch all files for authenticated user where 'is_archived' is 1
        $files = File::where('user_id',Auth::user()->id)->where('is_archived', 1)->get();

        return view('filemanagement.archived-files', compact('files'));
    }




    public function filesUpload(Request $request){
        return view('filemanagement.modals.uploadfile');
    }

    public function createFile(Request $request){
        $folders = Folder::where('user_id',Auth::user()->id)->get();
        return view('filemanagement.modals.create-file',compact('folders'));
    }

    public function createFolder(Request $request){
        return view('filemanagement.modals.create-folder');
    }
}
