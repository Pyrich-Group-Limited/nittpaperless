<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Memo;
use App\Models\MemoShare;
use App\Models\MemoComment;
use App\Models\Signature;
use App\Models\MemoSignature;
use App\Models\User;
use Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use App\Events\MemoSigned;

class MemoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */



     public function index(Request $request)
    {
        $userId = Auth::id(); // Get authenticated user ID

        //Query for Main Memos (Created by the user OR Shared with the user)
        $memos = Memo::where(function ($query) use ($userId) {
            $query->where('created_by', $userId)
                ->orWhereHas('shares', function ($q) use ($userId) {
                    $q->where('shared_with', $userId);
                });
        });

        //Apply title filter
        if ($request->filled('title')) {
            $memos->where('title', 'like', '%' . $request->input('title') . '%');
        }

        // Apply created_at filter
        if ($request->filled('created_at')) {
            $memos->whereDate('created_at', $request->input('created_at'));
        }

        $memos = $memos->orderBy('created_at', 'DESC')->get();

        //Query for Incoming Memos (Memos shared with the user)
        $incomingMemos = MemoShare::where('shared_with', $userId)
            ->whereHas('memo', function ($q) use ($request) {
                if ($request->filled('title')) {
                    $q->where('title', 'like', '%' . $request->input('title') . '%');
                }
                if ($request->filled('created_at')) {
                    $q->whereDate('created_at', $request->input('created_at'));
                }
            })
            ->orderBy('created_at', 'DESC')
            ->get();

        //Query for Outgoing Memos (Memos shared by the user)
        $outgoingMemos = MemoShare::where('shared_by', $userId)
            ->whereHas('memo', function ($q) use ($request) {
                if ($request->filled('title')) {
                    $q->where('title', 'like', '%' . $request->input('title') . '%');
                }
                if ($request->filled('created_at')) {
                    $q->whereDate('created_at', $request->input('created_at'));
                }
            })
            ->orderBy('created_at', 'DESC')
            ->get();

        return view('memos.index', compact('memos', 'outgoingMemos', 'incomingMemos'));
    }

    public function fetchMemos()
    {
        $memo = Memo::with(['creator.department', 'creator.unit'])->latest()->get();

        // $memos = Memo::with('creator.department')->latest()->get();
        return response()->json(['memos' => $memos]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('memos.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    // public function store(Request $request)
    // {
    //     $data = $request->validate([
    //         'title' => ['required', 'string'],
    //         'priority' => ['required'],
    //         'description' => ['required', 'string'],
    //         'content_type' => ['required', 'in:typed,uploaded'],
    //         'file_content' => 'required_if:content_type,typed',
    //         'memofile' => 'required_if:content_type,uploaded|mimes:pdf,doc,docx,png,jpg,jpeg|max:2048',
    //     ]);

    //     $filePath = null;

    //     if ($data['content_type'] === 'typed') {
    //         // First, create a memo record to pass into the PDF view
    //         $memo = Memo::create([
    //             'created_by' => Auth::id(),
    //             'title' => $data['title'],
    //             'priority' => $data['priority'],
    //             'description' => $data['description'],
    //             'file_path' => null, // temp placeholder
    //         ]);

    //         // Generate PDF using the created memo data
    //         $pdf = Pdf::loadView('memos.template', [
    //             'memo' => $memo,
    //             'content' => $data['file_content'],
    //             'title'   => $data['title'],
    //             'date'    => Carbon::now()->format('jS F Y'),
    //         ]);

    //         $fileName = 'memos/' . uniqid() . '.pdf';
    //         Storage::put($fileName, $pdf->output());

    //         // Update memo with file path
    //         $memo->update(['file_path' => $fileName]);

    //     } else {
    //         if ($request->hasFile('memofile')) {
    //             $filePath = $request->file('memofile')->store('memos');

    //             // Create memo with uploaded file
    //             Memo::create([
    //                 'created_by' => Auth::id(),
    //                 'title' => $data['title'],
    //                 'priority' => $data['priority'],
    //                 'description' => $data['description'],
    //                 'file_path' => $filePath,
    //             ]);
    //         } else {
    //             return redirect()->back()->with('error', 'File upload failed. Please try again.');
    //         }
    //     }

    //     return redirect()->back()->with('success', 'Memo created successfully.');
    // }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => ['required', 'string'],
            'priority' => ['required'],
            'to' => ['required'],
            'description' => ['nullable', 'string'],
            'memo_content' => ['nullable', 'string'],
            'memofile' => ['nullable', 'file', 'mimes:pdf,doc,docx,png,jpg,jpeg', 'max:2048'],
        ]);

        // Handle supporting document upload if present
        $supportingFilePath = null;
        if ($request->hasFile('memofile')) {
            $supportingFilePath = $request->file('memofile')->store('memos');
        }

        // Save the memo
        $memo = Memo::create([
            'created_by' => Auth::id(),
            'title' => $data['title'],
            'priority' => $data['priority'],
            'description' => $data['description'] ?? null,
            'memo_content' => $data['memo_content'] ?? null,
            'to' => $data['to'],
            'file_path' => $supportingFilePath,
        ]);

        return redirect()->back()->with('success', 'Memo created successfully.');
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    
    public function show($id)
    {

        $userSignature = Auth::user()->signature; // Check if user has a signature

        $isSigned = MemoSignature::where('memo_id', $id)->where('user_id', Auth::id())->exists(); // Check if user already signed
        $memoApprovals = Memo::with('signedUsers.signature')->findOrFail($id);
        $memo = Memo::find($id);
        $signatures = Signature::where('user_id', Auth::user()->id)->first();
        $memoShareComment = MemoShare::where('memo_id', $id)->where('shared_with', Auth::id())->first();

        $users = User::where('department_id',Auth::user()->department_id)->get();

       
        return view('memos.show', compact('memo', 'signatures','users','isSigned','userSignature','memoApprovals','memoShareComment'));
    }


    public function shareModal($id)
    {
        $memo = Memo::find($id);
        if (!$memo) {
            return redirect()->back()->with(['error' => 'Memo not found.']);
        }

        $signatures = Signature::where('user_id', $memo->created_by)->first();
        $authUser = Auth::user();

        // Default users collection
        $users = collect();

        if ($authUser->type == 'user') {
            $users = User::where('unit_id', $authUser->unit_id)
                ->where('department_id', $authUser->department_id)
                ->whereIn('type', ['supervisor', 'user'])
                ->get();
        } elseif ($authUser->type == 'supervisor') {
            $unitHeads = User::where('type', 'unit head')
                ->where('department_id', $authUser->department_id)->get();

            $otherUsers = User::where('type', 'user')
                ->where('department_id', $authUser->department_id)->get();

            $users = $unitHeads->merge($otherUsers);

        } elseif ($authUser->type == 'unit head') {
            $sameUnitAndDepartmentUsers = User::where('unit_id', $authUser->unit_id)
                ->where('department_id', $authUser->department_id)
                ->whereIn('type', ['user', 'director'])
                ->get();
        
            $unitHeadsOtherDepartments = User::where('type', 'unit head')
                ->where('department_id', '!=', $authUser->department_id)
                ->get();
        
            $departmentDirectors = User::where('type', 'director')
                ->where('department_id', $authUser->department_id)
                ->get();
        
            $users = $sameUnitAndDepartmentUsers
                ->merge($unitHeadsOtherDepartments)
                ->merge($departmentDirectors);
        
            // Check if unit head belongs to DG's Office
            if ($authUser->department?->name === "DG's Office") {
                $dgUsers = User::where('type', 'dg')->get();
                $users = $users->merge($dgUsers);
            }
        } elseif ($authUser->type == 'liaison officer') {
            $hQUsers = User::where('location', 'Headquarters')
                ->whereIn('type', ['dg', 'director'])
                ->get();

            $liasonOfficeUsers = User::where('location', 'Liaison-Offices')
                ->where('location_type', $authUser->location_type)->get();

            $users = $hQUsers->merge($liasonOfficeUsers);
        } elseif ($authUser->type == 'director') {
            $otherHods = User::where('type', 'director')->get();

            $others = User::where('department_id', $authUser->department_id)
                ->where('type', '!=', 'director')->get();

            $users = $otherHods->merge($others);
        } elseif (in_array($authUser->type, ['dg', 'super admin'])) {
            $users = User::all();
        } else {
            // Other user types can share with users in their unit/department
            $users = User::where('unit_id', $authUser->unit_id)
                ->orWhere('department_id', $authUser->department_id)
                ->get();
        }

        return view('memos.shareModal', compact('memo', 'signatures', 'users'));
    }


    // Share memo with another employee
    public function share(Request $request, $id)
    {
        $request->validate([
            'shared_with' => 'required|array', // Expect an array of user IDs
            'shared_with.*' => 'exists:users,id', // Ensure all IDs exist in users table
            'comment' => 'nullable|string',
            'secret_code' => 'required|string',
        ]);

        // Check if the provided secret code matches the user's stored secret code
        $user = Auth::user();
        if (!Hash::check($request->secret_code, $user->secret_code)) {
            return redirect()->back()->with(['error' => 'The secret code is incorrect.']);
        }

        // Loop through each user ID and create a MemoShare and MemoComment
        foreach ($request->shared_with as $sharedUserId) {
            MemoShare::create([
                'memo_id' => $id,
                'shared_with' => $sharedUserId,
                'shared_by' => Auth::id(),
                'comment' => $request->comment,
            ]);

            MemoComment::create([
                'memo_id' => $id,
                'user_id' => Auth::id(),
                'comment' => $request->comment,
            ]);
        }

        return redirect()->route('memos.index')->with('success', 'Memo shared successfully.');
    }

    // Method to handle signing a memo
    public function signMemo($id)
    {
        $memo = Memo::find($id);

        $signatures = Signature::where('user_id', Auth::user()->id)->first();
        // Check if the user has a signature before signing
        if (!$signatures) {
            return redirect()->back()->with('error', 'You must upload a signature before signing the memo');
        }

        // Check if the user has already signed the memo
        $alreadySigned = MemoSignature::where('memo_id', $memo->id)->where('user_id', Auth::id())->exists();

        if ($alreadySigned) {
            return redirect()->back()->with('error', 'You have already signed this memo.');
        }

        // Create a new memo signature
        MemoSignature::create([
            'memo_id' => $memo->id,
            'user_id' => Auth::id(),
        ]);
        event(new MemoSigned($memo));

        return redirect()->back()->with('success', 'Memo signed successfully.');
    }

    public function download(Memo $memo)
    {
        $memo->load(['signedUsers.signature', 'creator.unit']);

        $pdf = Pdf::loadView('memos.template', [
            'memo' => $memo,
            'content' => $memo->memo_content,
            'title' => $memo->title,
            'date' => now()->format('jS F Y'),
            'to' => $memo->to,
        ])->setPaper('A4', 'portrait');

        return $pdf->stream('memo_'.$memo->id.'.pdf'); 
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
