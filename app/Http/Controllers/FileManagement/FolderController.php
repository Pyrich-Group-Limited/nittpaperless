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
        $sortOrder = $request->get('sort', 'newest');

        // Get the authenticated user's details
        $user = Auth::user();
        $userDepartmentId = $user->department_id;
        $userUnitId = $user->unit_id;
        $userLocationType = $user->location_type;

        // Initialize the query
        $query = Folder::query();

        // Apply visibility and permissions logic
        $query->where(function ($q) use ($user, $userDepartmentId, $userUnitId, $userLocationType) {
            // Personal folders: Only the user can see their own personal folders
            $q->where(function ($subQuery) use ($user) {
                $subQuery->where('visibility', 'personal')
                    ->where('user_id', $user->id);
            });

            // Department folders: Only users within the same department and location can see
            if ($user->can('view department folders')) {
                $q->orWhere(function ($subQuery) use ($userDepartmentId, $userLocationType) {
                    $subQuery->where('visibility', 'department')
                        ->where('department_id', $userDepartmentId)
                        ->where('location_type', $userLocationType);
                });
            }

            // Unit folders: Only users within the same unit and location can see
            if ($user->can('view unit folders')) {
                $q->orWhere(function ($subQuery) use ($userUnitId, $userLocationType) {
                    $subQuery->where('visibility', 'unit')
                        ->where('unit_id', $userUnitId)
                        ->where('location_type', $userLocationType);
                });
            }
        });

        // Apply search filter
        if ($search) {
            $query->where('folder_name', 'LIKE', "%{$search}%");
        }

        // Apply sorting order
        if ($sortOrder === 'newest') {
            $query->orderBy('created_at', 'desc');
        } else {
            $query->orderBy('created_at', 'asc');
        }

        // Retrieve only top-level folders (parent_id is null)
        $folders = $query->whereNull('parent_id')->paginate(12);

        return view('filemanagement.folders', compact('folders', 'sortOrder'));
    }




    public function createFolderModal(){
        $folders = Folder::where('department_id',Auth::user()->department_id)
        ->where('location_type',Auth::user()->location_type)->get();
        return view('filemanagement.modals.create-folder',compact('folders'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'parent_id' => 'nullable|exists:folders,id',
            'visibility' => 'required|in:department,unit,personal',
        ]);

        // Check if the folder is already at the 3rd level
        $parentFolder = Folder::find($request->parent_id);
        if ($parentFolder && $parentFolder->parent && $parentFolder->parent->parent) {
            return redirect()->back()->with('error', 'You cannot create more than 3 layers of folders.');
        }

        $user = Auth::user();

        // Assign department or unit based on the selected visibility
        $departmentId = $request->visibility === 'department' ? $user->department_id : null;
        $unitId = $request->visibility === 'unit' ? $user->unit_id : null;

        Folder::create([
            'folder_name' => $request->name,
            'user_id' => $user->id,
            'parent_id' => $request->parent_id,
            'department_id' => $departmentId,
            'unit_id' => $unitId ?? null,
            'location_type' => $user->location_type,
            'visibility' => $request->visibility,
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

    public function display(Folder $folder)
    {
        // Get direct children of the selected folder
        $subfolders = $folder->children;

        return view('filemanagement.folder-display', compact('folder', 'subfolders'));
    }
}
