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

        // Search, filter, and sorting options
        $search = $request->input('search');
        $sortBy = $request->input('sortBy', 'file_name'); // Default sort by name
        $order = $request->input('order', 'desc'); // Default order ascending

         // Query documents with folders
        $documentsQuery = File::with('folder');

        // Search by document name or folder name
        if ($search) {
            $documentsQuery->where('file_name', 'like', "%$search%")
            ->orWhereHas('folder', function($query) use ($search) {
                $query->where('folder_name', 'like', "%$search%");
            });
        }

        // Sorting
        $documentsQuery->orderBy($sortBy, $order);

        // Fetch grouped documents by folder
        $documents = $documentsQuery->where('user_id',Auth::user()->id)->get()->groupBy('folder.folder_name');

        $users = User::all();

        // Fetch files that are not in any folder (root-level files)
        $rootFiles = Auth::user()->files()->whereNull('folder_id')->get();

        $folders = Folder::where('user_id',Auth::user()->id)->get();

        return view('filemanagement.index', compact(
        'rootFiles','users',
        'documents', 'search', 'sortBy', 'order','folders'
    ));
    }

    //function for storing files
    public function store(Request $request)
    {
        $request->validate([
            'filename' => 'required|string|max:255',
            'file' => 'required|file|mimes:jpg,png,pdf,docx,pdf,xlxs,txt|max:2048',
            'folder_id' => 'nullable|exists:folders,id',
        ]);

         // Handle file upload
         if ($request->hasFile('file')) {
            $file = $request->file('file');
            $filePath = $file->store('files'); // Store file in 'files' folder

            // Create a new document entry in the database
            File::create([
                'file_name' => $request->filename,
                'path' => $filePath,
                'user_id' => Auth::id(),
                'folder_id' => $request->folder_id,
            ]);
        }



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
