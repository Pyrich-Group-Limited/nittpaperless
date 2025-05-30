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

    // public function index(Request $request)
    // {
    //     // Search, filter, and sorting options
    //     $search = $request->input('search');
    //     $sortBy = $request->input('sortBy', 'file_name');
    //     $order = $request->input('order', 'desc');

    //     // Get the authenticated user and their attributes
    //     $user = Auth::user();
    //     $userDepartmentId = $user->department_id;
    //     $userUnitId = $user->unit_id;
    //     $userLocationType = $user->location_type;

    //     // Initialize the documents query
    //     $documentsQuery = File::with('folder')->where('is_archived', false);

    //     // Apply visibility and permissions logic
    //     $documentsQuery->where(function ($query) use ($user, $userDepartmentId, $userUnitId, $userLocationType) {
    //         // Personal files (Only the owner can see them)
    //         $query->where(function ($q) use ($user) {
    //             $q->where('visibility', 'personal')
    //             ->where('user_id', $user->id);
    //         });

    //         // Department files (Users in the same department can see)
    //         if ($user->can('view department documents')) {
    //             $query->orWhere(function ($q) use ($userDepartmentId, $userLocationType) {
    //                 $q->where('visibility', 'department')
    //                 ->where('department_id', $userDepartmentId)
    //                 ->where('location_type', $userLocationType);
    //             });
    //         }

    //         // Unit files (Users in the same unit can see)
    //         if ($user->can('view unit documents')) {
    //             $query->orWhere(function ($q) use ($userUnitId, $userLocationType) {
    //                 $q->where('visibility', 'unit')
    //                 ->where('unit_id', $userUnitId)
    //                 ->where('location_type', $userLocationType);
    //             });
    //         }
    //     });

    //     // Apply search filter if needed
    //     if ($search) {
    //         $documentsQuery->where(function ($query) use ($search) {
    //             $query->where('file_name', 'like', "%$search%")
    //                 ->orWhereHas('folder', function ($q) use ($search) {
    //                     $q->where('folder_name', 'like', "%$search%");
    //                 });
    //         });
    //     }

    //     // Apply sorting
    //     $documentsQuery->orderBy($sortBy, $order);

    //     // Get files grouped by folder
    //     $documents = $documentsQuery->get()->groupBy('folder.folder_name');

    //     // Get all users
    //     $users = User::all();

    //     // Get root-level files that match visibility
    //     $rootFilesQuery = File::whereNull('folder_id')
    //         ->where('is_archived', false);

    //     $rootFilesQuery->where(function ($query) use ($user, $userDepartmentId, $userUnitId, $userLocationType) {
    //         // Personal files (Only the owner can see)
    //         $query->where(function ($q) use ($user) {
    //             $q->where('visibility', 'personal')
    //             ->where('user_id', $user->id);
    //         });

    //         // Department files
    //         if ($user->can('view department documents')) {
    //             $query->orWhere(function ($q) use ($userDepartmentId, $userLocationType) {
    //                 $q->where('visibility', 'department')
    //                 ->where('department_id', $userDepartmentId)
    //                 ->where('location_type', $userLocationType);
    //             });
    //         }

    //         // Unit files
    //         if ($user->can('view unit documents')) {
    //             $query->orWhere(function ($q) use ($userUnitId, $userLocationType) {
    //                 $q->where('visibility', 'unit')
    //                 ->where('unit_id', $userUnitId)
    //                 ->where('location_type', $userLocationType);
    //             });
    //         }
    //     });

    //     $rootFiles = $rootFilesQuery->get();

    //     // Get folders based on visibility
    //     $foldersQuery = Folder::query();

    //     $foldersQuery->where(function ($query) use ($user, $userDepartmentId, $userUnitId, $userLocationType) {
    //         // Personal folders
    //         $query->where(function ($q) use ($user) {
    //             $q->where('visibility', 'personal')
    //             ->where('user_id', $user->id);
    //         });

    //         // Department folders
    //         if ($user->can('view department documents')) {
    //             $query->orWhere(function ($q) use ($userDepartmentId, $userLocationType) {
    //                 $q->where('visibility', 'department')
    //                 ->where('department_id', $userDepartmentId)
    //                 ->where('location_type', $userLocationType);
    //             });
    //         }

    //         // Unit folders
    //         if ($user->can('view unit documents')) {
    //             $query->orWhere(function ($q) use ($userUnitId, $userLocationType) {
    //                 $q->where('visibility', 'unit')
    //                 ->where('unit_id', $userUnitId)
    //                 ->where('location_type', $userLocationType);
    //             });
    //         }
    //     });

    //     $folders = $foldersQuery->get();

    //     return view('filemanagement.index', compact(
    //         'rootFiles', 'users', 'documents', 'search', 'sortBy', 'order', 'folders'
    //     ));
    // }

    public function index(Request $request)
    {
        // Get search, sorting, and filter options
        $search = $request->input('search');
        $sortBy = $request->input('sortBy', 'file_name');
        $visibilityFilter = $request->input('visibility', 'all'); // Default to "all"

        // Get authenticated user details
        $user = Auth::user();
        $userDepartmentId = $user->department_id;
        $userUnitId = $user->unit_id;
        $userLocationType = $user->location_type;

        // Initialize the documents query
        $documentsQuery = File::with('folder')->where('is_archived', false);

        // Apply visibility filter and permissions
        $documentsQuery->where(function ($query) use ($user, $userDepartmentId, $userUnitId, $userLocationType, $visibilityFilter) {

            // Personal files (Only the owner can see them)
            if ($visibilityFilter === 'personal' || $visibilityFilter === 'all') {
                $query->orWhere(function ($q) use ($user) {
                    $q->where('visibility', 'personal')
                        ->where('user_id', $user->id);
                });
            }

            // Department files (Only users in the same department can see)
            if (($visibilityFilter === 'department' || $visibilityFilter === 'all') && $user->can('view department documents')) {
                $query->orWhere(function ($q) use ($userDepartmentId, $userLocationType) {
                    $q->where('visibility', 'department')
                        ->where('department_id', $userDepartmentId)
                        ->where('location_type', $userLocationType);
                });
            }

            // Unit files (Only users in the same unit can see)
            if (($visibilityFilter === 'unit' || $visibilityFilter === 'all') && $user->can('view unit documents')) {
                $query->orWhere(function ($q) use ($userUnitId, $userLocationType) {
                    $q->where('visibility', 'unit')
                        ->where('unit_id', $userUnitId)
                        ->where('location_type', $userLocationType);
                });
            }
        });

        // Apply search filter
        if ($search) {
            $documentsQuery->where(function ($query) use ($search) {
                $query->where('file_name', 'like', "%$search%")
                    ->orWhereHas('folder', function ($q) use ($search) {
                        $q->where('folder_name', 'like', "%$search%");
                    });
            });
        }

        // Apply sorting (Only descending order)
        $documentsQuery->orderBy($sortBy, 'desc');

        // Get files grouped by folder
        $documents = $documentsQuery->get()->groupBy('folder.folder_name');

        // Get all users
        $users = User::all();

        // Get root-level files based on visibility filter
        $rootFilesQuery = File::whereNull('folder_id')->where('is_archived', false);
        $this->applyVisibilityFilter($rootFilesQuery, $user, $userDepartmentId, $userUnitId, $userLocationType, $visibilityFilter);
        $rootFiles = $rootFilesQuery->get();

        // Get folders based on visibility filter
        $foldersQuery = Folder::query();
        $this->applyVisibilityFilter($foldersQuery, $user, $userDepartmentId, $userUnitId, $userLocationType, $visibilityFilter);
        $folders = $foldersQuery->get();

        return view('filemanagement.index', compact(
            'rootFiles', 'users', 'documents', 'search', 'sortBy', 'folders', 'visibilityFilter'
        ));
    }

    private function applyVisibilityFilter($query, $user, $userDepartmentId, $userUnitId, $userLocationType, $visibilityFilter)
    {
        $query->where(function ($q) use ($user, $userDepartmentId, $userUnitId, $userLocationType, $visibilityFilter) {

            if ($visibilityFilter === 'personal' || $visibilityFilter === 'all') {
                $q->orWhere(function ($subQuery) use ($user) {
                    $subQuery->where('visibility', 'personal')->where('user_id', $user->id);
                });
            }

            if (($visibilityFilter === 'department' || $visibilityFilter === 'all') && $user->can('view department documents')) {
                $q->orWhere(function ($subQuery) use ($userDepartmentId, $userLocationType) {
                    $subQuery->where('visibility', 'department')
                        ->where('department_id', $userDepartmentId)
                        ->where('location_type', $userLocationType);
                });
            }

            if (($visibilityFilter === 'unit' || $visibilityFilter === 'all') && $user->can('view unit documents')) {
                $q->orWhere(function ($subQuery) use ($userUnitId, $userLocationType) {
                    $subQuery->where('visibility', 'unit')
                        ->where('unit_id', $userUnitId)
                        ->where('location_type', $userLocationType);
                });
            }
        });
    }


    public function store(Request $request)
    {
        $request->validate([
            'filename' => 'required|string|max:255',
            'files' => 'nullable|array', // Ensure files is an array
            'files.*' => 'nullable|mimes:jpg,jpeg,png,pdf,doc,docx|max:2048', // Validate each file
            'content' => 'nullable|string',
            'folder_id' => 'nullable|exists:folders,id',
            'visibility' => 'required|in:personal,unit,department',
        ]);

        $user = Auth::user();
        $uploadedFiles = [];

        // Ensure either files or content is provided
        if (!$request->hasFile('files') && !$request->filled('content')) {
            return redirect()->back()->with(['error' => 'Please provide either a file or document content.']);
        }

        // Handle uploaded files
        if ($request->hasFile('files')) {
            foreach ($request->file('files') as $file) {
                $filePath = $file->store('files', 'public'); // Store files in public storage
                $fileName = $file->getClientOriginalName();

                // Save file metadata in the database
                $fileEntry = File::create([
                    'file_name' => $fileName,
                    'path' => $filePath,
                    'user_id' => $user->id,
                    'folder_id' => $request->folder_id,
                    'department_id' => $request->visibility === 'department' ? $user->department_id : null,
                    'unit_id' => $request->visibility === 'unit' ? $user->unit_id : null,
                    'location_type' => $user->location_type,
                    'visibility' => $request->visibility,
                ]);

                $uploadedFiles[] = $fileEntry;
            }
        }

        // Handle text content (PDF/DOCX)
        if ($request->filled('content')) {
            $content = $request->input('content');
            $format = $request->input('format', 'pdf'); // Default format is PDF
            $filePath = 'files/' . $request->filename . '.' . $format;

            if ($format === 'pdf') {
                // Generate PDF
                $dompdf = new Dompdf();
                $dompdf->loadHtml($content);
                $dompdf->setPaper('A4', 'portrait');
                $dompdf->render();
                Storage::put($filePath, $dompdf->output());
            } elseif ($format === 'docx') {
                // Generate DOCX
                $phpWord = new PhpWord();
                $section = $phpWord->addSection();
                $section->addText($content);

                $tempFilePath = tempnam(sys_get_temp_dir(), 'docx');
                $phpWord->save($tempFilePath, 'Word2007');

                // Save DOCX to storage
                Storage::put($filePath, file_get_contents($tempFilePath));
                unlink($tempFilePath);
            }

            // Save content file metadata
            $fileEntry = File::create([
                'file_name' => $request->filename,
                'path' => $filePath,
                'user_id' => $user->id,
                'folder_id' => $request->folder_id,
                'department_id' => Auth::user()->department_id ?? null,
                'unit_id' => Auth::user()->unit_id ?: null,
                'location_type' => $user->location_type,
                'visibility' => $request->visibility,
            ]);

            $uploadedFiles[] = $fileEntry;
        }

        return redirect()->back()->with('success', count($uploadedFiles) . ' file(s) uploaded successfully.');
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
            $users = User::where('department_id', $authUser->department_id)
                ->where(function ($query) use ($authUser) {
                    $query->where('unit_id', $authUser->unit_id)
                        ->whereNotIn('type', ['unit head', 'director'])
                        ->orWhereIn('type', ['unit head', 'director']);
                })
                ->get();

        }elseif($authUser->type=='liaison officer'){
            $hQUsers = User::where('location','Headquarters')
            ->where('type', 'dg')
            ->where('type', 'director')->get();

            $liasonOfficeUsers = User::where('location', 'Liaison-Offices')
            ->where('location_type', $authUser->location_type)->get();
            $users = $hQUsers->merge($liasonOfficeUsers);

        }elseif($authUser->type=='director'){
            $otherHods = User::where('type','director')
            ->orWhere('type', 'dg')->get();

            $others = User::where('department_id',$authUser->department_id)
            ->where('type','!=','director')->get();
            $users = $otherHods->merge($others);

        }elseif($authUser->type=='dg' || $authUser->type=='super admin'){
            $users = User::where('type','!=','contractor')->get();
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
            return redirect()->back()->with('error', 'This file is already archived.');
        }
        $file->is_archived = 1;
        $file->save();

        return redirect()->back()->with('success', 'File archived successfully.');
    }

    // List all archived files
    // public function archived()
    // {
    //     $files = File::where('department_id',Auth::user()->department_id)
    //     ->where('location_type',Auth::user()->location_type)
    //     ->where('is_archived', 1)->get();

    //     return view('filemanagement.archived-files', compact('files'));
    // }

    // public function archived()
    // {
    //     $user = Auth::user(); // Get the authenticated user

    //     $files = File::where('is_archived', 1) // Only archived files
    //         ->where(function ($query) use ($user) {
    //             // Personal files (only the owner can see)
    //             $query->where(function ($q) use ($user) {
    //                 $q->where('visibility', 'personal')
    //                     ->where('user_id', $user->id);
    //             });

    //             // Department files (only users in the same department can see)
    //             if ($user->can('view department documents')) {
    //                 $query->orWhere(function ($q) use ($user) {
    //                     $q->where('visibility', 'department')
    //                         ->where('department_id', $user->department_id)
    //                         ->where('location_type', $user->location_type);
    //                 });
    //             }

    //             // Unit files (only users in the same unit can see)
    //             if ($user->can('view unit documents')) {
    //                 $query->orWhere(function ($q) use ($user) {
    //                     $q->where('visibility', 'unit')
    //                         ->where('unit_id', $user->unit_id)
    //                         ->where('location_type', $user->location_type);
    //                 });
    //             }
    //         })
    //         ->get();

    //     return view('filemanagement.archived-files', compact('files'));
    // }
    public function archived(Request $request)
    {
        $user = Auth::user(); // Get the authenticated user

        // Get filter values from request
        $visibilityFilter = $request->query('visibility'); // 'personal', 'unit', 'department'

        // Query archived files
        $filesQuery = File::where('is_archived', 1)
            ->where(function ($query) use ($user, $visibilityFilter) {
                // Personal files (only the owner can see)
                if ($visibilityFilter === 'personal' || !$visibilityFilter) {
                    $query->orWhere(function ($q) use ($user) {
                        $q->where('visibility', 'personal')
                            ->where('user_id', $user->id);
                    });
                }

                // Department files (only users in the same department)
                if (($visibilityFilter === 'department' || !$visibilityFilter) && $user->can('view department documents')) {
                    $query->orWhere(function ($q) use ($user) {
                        $q->where('visibility', 'department')
                            ->where('department_id', $user->department_id)
                            ->where('location_type', $user->location_type);
                    });
                }

                // Unit files (only users in the same unit)
                if (($visibilityFilter === 'unit' || !$visibilityFilter) && $user->can('view unit documents')) {
                    $query->orWhere(function ($q) use ($user) {
                        $q->where('visibility', 'unit')
                            ->where('unit_id', $user->unit_id)
                            ->where('location_type', $user->location_type);
                    });
                }
            });

        // Paginate results (10 per page)
        $files = $filesQuery->paginate(12);

        return view('filemanagement.archived-files', compact('files', 'visibilityFilter'));
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
