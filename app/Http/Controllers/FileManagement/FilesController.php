<?php

namespace App\Http\Controllers\FileManagement;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\File;
use App\Models\Folder;
use App\Models\User;
use Carbon\Carbon;
use Dompdf\Dompdf;
use PhpOffice\PhpWord\PhpWord;

class FilesController extends Controller
{
    // public function index(Request $request){

    //     // Search, filter, and sorting options
    //     $search = $request->input('search');
    //     $sortBy = $request->input('sortBy', 'file_name');
    //     $order = $request->input('order', 'desc');

    //      // Query documents with folders
    //     $documentsQuery = File::with('folder');

    //     // Search by document name or folder name
    //     if ($search) {
    //         $documentsQuery->where('file_name', 'like', "%$search%")
    //         ->orWhereHas('folder', function($query) use ($search) {
    //             $query->where('folder_name', 'like', "%$search%");
    //         });
    //     }

    //     // Sorting
    //     $documentsQuery->orderBy($sortBy, $order);

    //     // Fetch grouped documents by folder
    //     $documents = $documentsQuery->where('department_id', Auth::user()->department_id)
    //     ->where('location_type', Auth::user()->location_type)
    //     ->where('is_archived', false)
    //     ->get()->groupBy('folder.folder_name');

    //     $users = User::all();

    //     // Fetch files that are not in any folder (root-level files)
    //     $rootFiles = Auth::user()->files()->whereNull('folder_id')->get();

    //     $folders = Folder::where('department_id', Auth::user()->department_id)
    //     ->where('location_type', Auth::user()->location_type)
    //     ->get();

    //     return view('filemanagement.index', compact(
    //     'rootFiles','users',
    //     'documents', 'search', 'sortBy', 'order','folders'
    //     ));
    // }

    public function index(Request $request)
    {
        // Search, filter, and sorting options
        $search = $request->input('search');
        $sortBy = $request->input('sortBy', 'file_name');
        $order = $request->input('order', 'desc');

        // Get the authenticated user and their attributes
        $user = Auth::user();
        $userDepartmentId = $user->department_id;
        $userUnitId = $user->unit_id;
        $userLocationType = $user->location_type;

        // Initialize the documents query
        $documentsQuery = File::with('folder')->where('is_archived', false);

        // Check user permissions
        if ($user->can('view department documents')) {
            // User can view department documents
            $documentsQuery->where('department_id', $userDepartmentId)
                        ->where('location_type', $userLocationType);
        } elseif ($user->can('view unit documents')) {
            // User can view unit documents
            $documentsQuery->where('unit_id', $userUnitId)
                ->where('location_type', $userLocationType);
        } else {
            // If the user has no relevant permissions, return an empty collection
            $documents = collect([]);
            $rootFiles = collect([]);
            $folders = collect([]);
            return view('filemanagement.index', compact(
                'documents', 'search', 'sortBy', 'order', 'folders', 'rootFiles', 'users'
            ));
        }

        // Search by document name or folder name
        if ($search) {
            $documentsQuery->where('file_name', 'like', "%$search%")
                ->orWhereHas('folder', function ($query) use ($search) {
                    $query->where('folder_name', 'like', "%$search%");
                });
        }

        // Sorting
        $documentsQuery->orderBy($sortBy, $order);

        // Fetch grouped documents by folder
        $documents = $documentsQuery->get()->groupBy('folder.folder_name');

        // Fetch all users
        $users = User::all();

        // Fetch files that are not in any folder (root-level files)
        $rootFiles = File::where('department_id', $userDepartmentId)
            ->whereNull('folder_id')
            ->where('location_type', $userLocationType)
            ->where('is_archived', false)
            ->get();

        // Fetch folders
        $foldersQuery = Folder::query();

        if ($user->can('view department documents')) {
            $folders = $foldersQuery->where('department_id', $userDepartmentId)
                ->where('location_type', $userLocationType)
                ->get();
        } elseif ($user->can('view unit documents')) {
            $folders = $foldersQuery->where('unit_id', $userUnitId)
                    ->where('location_type', $userLocationType)
                    ->get();
        } else {
            $folders = collect([]);
        }

        return view('filemanagement.index', compact(
            'rootFiles', 'users', 'documents', 'search', 'sortBy', 'order', 'folders'
        ));
    }


    public function store(Request $request)
    {
        $request->validate([
            'filename' => 'required|string|max:255',
            'file' => 'nullable|file|mimes:jpg,png,pdf,docx,xlsx,txt|max:2048',
            'content' => 'nullable|string',
            'folder_id' => 'nullable|exists:folders,id',
        ]);

        // Ensure either a file or content is provided
        if (!$request->hasFile('file') && !$request->filled('content')) {
            return redirect()->back()->with(['error' => 'Please provide either a file or document content.']);
        }

        $filePath = null; // Path to store the file
        $fileName = $request->filename;

        // Handle uploaded file
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $filePath = $file->store('files');
        }
        // Handle text content
        elseif ($request->filled('content')) {
            $content = $request->input('content');
            $format = $request->input('format', 'pdf'); // Default format is PDF

            if ($format === 'pdf') {
                // Generate PDF
                $dompdf = new Dompdf();
                $dompdf->loadHtml($content);
                $dompdf->setPaper('A4', 'portrait');
                $dompdf->render();
                $output = $dompdf->output();

                // Save PDF to storage
                $filePath = 'files/' . $fileName . '.pdf';
                Storage::put($filePath, $output);
            } elseif ($format === 'docx') {
                // Generate DOCX
                $phpWord = new PhpWord();
                $section = $phpWord->addSection();
                $section->addText($content);

                $tempFilePath = tempnam(sys_get_temp_dir(), 'docx');
                $phpWord->save($tempFilePath, 'Word2007');

                // $tempFilePath = storage_path('files/' . $fileName . '.docx');
                // $phpWord->save($tempFilePath, 'Word2007');

                // Save DOCX to storage
                $filePath = 'files/' . $fileName . '.docx';
                Storage::put($filePath, file_get_contents($tempFilePath));

                // Clean up temp file
                unlink($tempFilePath);
            }
        }

        // Save file metadata in the database
        if ($filePath) {
            File::create([
                'file_name' => $fileName,
                'path' => $filePath,
                'user_id' => Auth::id(),
                'folder_id' => $request->folder_id,
                'department_id' => Auth::user()->department_id,
                'unit_id' => Auth::user()->unit_id ?? null,
                'location_type' => Auth::user()->location_type,
            ]);
        }
        return redirect()->back()->with('success', 'File saved successfully.');
    }

    public function download(File $file)
    {
        // Get the file's path and file name from the database
        $filePath = $file->path;
        $fileName = $file->file_name;

        // Ensure the file has the correct extension
        $fileExtension = pathinfo($filePath, PATHINFO_EXTENSION);

        // Append the extension to the file name if not already included
        if (!str_ends_with($fileName, '.' . $fileExtension)) {
            $fileName .= '.' . $fileExtension;
        }

        // Check if the file exists in storage
        if (Storage::exists($filePath)) {
            // Return the file for download with the correct name and extension
            return Storage::download($filePath, $fileName);
        } else {
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

        $file=File::find($id);

        $authUser = Auth::user();

        if($authUser->type=='user'){
            $users = User::where('unit_id', $authUser->unit_id)
            ->where('department_id', $authUser->department_id)
            ->where('type', 'supervisor')
            ->orWhere('type', 'user')->get();

        }elseif($authUser->type=='supervisor'){

            $unitHeads = User::where('type', 'unit head')
            ->where('department_id', $authUser->department_id)->get();
            $otherUsers = User::where('type', 'user')
            ->where('department_id', $authUser->department_id)->get();
            $users = $unitHeads->merge($otherUsers);

        }elseif($authUser->type=='unit head'){
            $sameUnitAndDepartmentUsers = User::where('unit_id', $authUser->unit_id)
            ->where('department_id', $authUser->department_id)
            ->where('type', 'user')->orWhere('type', 'hod')
            ->get();

            $unitHeadsOtherDepartments = User::where('type', 'unit head')
            ->where('department_id', '!=', $authUser->department_id)->get();
            $users = $sameUnitAndDepartmentUsers->merge($unitHeadsOtherDepartments);

        }elseif($authUser->type=='liason office head'){
            $hQUsers = User::where('location','Headquarters')
            ->where('type', 'DG')
            ->where('type', 'hod')->get();

            $liasonOfficeUsers = User::where('location', 'Liaison-Offices')
            ->where('location_type', $authUser->location_type)->get();
            $users = $hQUsers->merge($liasonOfficeUsers);

        }elseif($authUser->type=='hod'){
            $otherHods = User::where('type','hod')
            ->get();

            $others = User::where('department_id',$authUser->department_id)
            ->where('type','!=','hod')->get();
            $users = $otherHods->merge($others);

        }elseif($authUser->type=='DG' || $authUser->type=='super admin'){
            $users = User::all();
        }else {
            return redirect()->back()->with('error', 'You are not authorized to view this page.');
        }

        return view('filemanagement.modals.share-modal',compact('users','file'));
    }


    public function share(File $file, Request $request)
    {

        // if (!($file->user_id === Auth::id() || $file->sharedWith()->where('user_id', Auth::id())->exists())) {
        //     abort(403, 'This action is unauthorized.');
        // }

        // Validate input
        $request->validate([
            'user_id' => 'required|array',
            'user_id.*' => 'exists:users,id',
            'secret_code' => 'required|string',
            'priority' => 'required|integer',
        ]);

        // Check the secret code
        if (!Hash::check($request->secret_code, Auth::user()->secret_code)) {
            return redirect()->back()->with(['error' => 'Invalid secret code.']);
        }

        // Find the users to share the file with
        $users = User::whereIn('id', $request->user_id)->get();

        foreach ($users as $user) {
            // Add a new shared entry (always creates a new record)
            $file->sharedWith()->attach([
                $user->id => [
                    'sharer_id' => Auth::id(), // Current sharer
                    'priority' => $request->input('priority'),
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
            ]);

            createNotification(
                $user->id,
                'File Shared with You',
                'A file has been shared with you by ' . Auth::user()->name,
                route('sharedfiles.index')
            );
        }

        return redirect()->back()->with('success', 'File shared successfully.');
    }


    public function sharedFiles(Request $request)
    {
        $filesSharedByUser = File::whereHas('sharedWith', function ($query) {
            $query->where('sharer_id', Auth::id()); // Filter files where sharer_id matches the authenticated user
        })
        ->with(['sharedWith' => function ($query) {
            $query->where('sharer_id', Auth::id()); // Ensure only the authenticated user's shared records are loaded
        }])
        ->orderBy('created_at', 'desc')
        ->get();


        $filesSharedWithUser = File::whereHas('sharedWith', function ($query) {
            $query->where('user_id', Auth::id()); // Fetch rows for the authenticated user
        })
        ->with(['sharedWith' => function ($query) {
            $query->where('user_id', Auth::id()); // Load only the authenticated user's pivot data
        }, 'sharedWith.pivotSharer']) // Load the sharer relationship
        ->orderBy('created_at', 'desc')
        ->get();

        return view('filemanagement.shared-files', compact('filesSharedByUser', 'filesSharedWithUser'));
    }

    // public function shareHistory(File $file)
    // {
    //     $shareHistory = $file->sharedWith()->withPivot(['sharer_id', 'priority'])->get();

    //     return view('filemanagement.share-history', compact('file', 'shareHistory'));
    // }




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
        $files = File::where('department_id',Auth::user()->department_id)
        ->where('location_type',Auth::user()->location_type)
        ->where('is_archived', 1)->get();

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
