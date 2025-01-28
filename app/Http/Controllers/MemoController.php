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

class MemoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */



    public function index()
    {
        $memos = Memo::where('created_by', Auth::id())->orWhereHas('shares', function ($query) {
            $query->where('shared_with', Auth::id());
        })->orderBy('created_at','DESC')->get();

        $incomingMemos = MemoShare::where('shared_with', Auth::id())->orderBy('created_at','DESC')->get();
        $outgoingMemos = MemoShare::where('shared_by', Auth::id())->orderBy('created_at','DESC')->get();

        return view('memos.index', compact('memos','outgoingMemos','incomingMemos'));
    }

    public function fetchMemos()
    {
        $memos = Memo::with('creator.department')->latest()->get();
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

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => ['required', 'string'],
            'priority' => ['required'],
            'description' => ['required', 'string'],
            'content_type' => ['required', 'in:typed,uploaded'],
            'file_content' => 'required_if:content_type,typed',
            'memofile' => 'required_if:content_type,uploaded|mimes:pdf,doc,docx,png,jpg,jpeg|max:2048',
        ]);

        $filePath = null;

        if ($data['content_type'] === 'typed') {
            // Generate PDF from the typed content
            $pdf = Pdf::loadView('memos.template', ['content' => $data['file_content']]);
            $fileName = 'memos/' . uniqid() . '.pdf';
            Storage::put($fileName, $pdf->output());
            $filePath = $fileName;
        } else  {
            if ($request->hasFile('memofile')) {
                $filePath = $request->file('memofile')->store('memos');
            } else {
                return redirect()->back()->with('error', 'File upload failed. Please try again.');
            }
        }

        Memo::create([
            'created_by' => Auth::id(),
            'title' => $data['title'],
            'priority' => $data['priority'],
            'description' => $data['description'],
            'file_path' => $filePath,
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
        $signatures = Signature::where('user_id', $memo->created_by)->first();

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
            ->where('type', 'user')->orWhere('type', 'director')
            ->get();

            $unitHeadsOtherDepartments = User::where('type', 'unit head')
            ->where('department_id', '!=', $authUser->department_id)->get();
            $users = $sameUnitAndDepartmentUsers->merge($unitHeadsOtherDepartments);

        }elseif($authUser->type=='liaison officer'){
            $hQUsers = User::where('location','Headquarters')
            ->where('type', 'DG')
            ->where('type', 'director')->get();

            $liasonOfficeUsers = User::where('location', 'Liaison-Offices')
            ->where('location_type', $authUser->location_type)->get();
            $users = $hQUsers->merge($liasonOfficeUsers);

        }elseif($authUser->type=='director'){
            $otherHods = User::where('type','director')
            ->get();

            $others = User::where('department_id',$authUser->department_id)
            ->where('type','!=','director')->get();
            $users = $otherHods->merge($others);

        }elseif($authUser->type=='DG' || $authUser->type=='super admin'){
            $users = User::all();
        }else {
            return redirect()->back()->with(['error' => 'You are not authorized to view this page.']);
        }

        return view('memos.shareModal', compact('memo', 'signatures','users'));
    }

    // Share memo with another employee
    public function share(Request $request, $id)
    {
        $request->validate([
            'shared_with' => 'required|exists:users,id',
            'comment' => 'nullable',
            'secret_code' => 'required|string',
        ]);

        // Check if the provided secret code matches the user's stored secret code
        $user = Auth::user();

        if (!Hash::check($request->secret_code, $user->secret_code)) {
            return redirect()->back()->with(['error' => 'The secret code is incorrect.']);
        }

        $memoShare = MemoShare::create([
            'memo_id' => $id,
            'shared_with' => $request->shared_with,
            'shared_by' => Auth::id(),
            'comment' => $request->comment,
        ]);

        MemoComment::create([
            'memo_id' => $id,
            'user_id' => Auth::id(),
            'comment' => $request->comment,
        ]);

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

        return redirect()->back()->with('success', 'Memo signed successfully.');
    }


    // Method to download the file
    public function download(Memo $memo)
    {
        // Get the file's path from the database
        $filePath = $memo->file_path;
        // Check if the file exists in storage
        if (Storage::exists($filePath)) {
            // Return the file for download
            return Storage::download($filePath, $memo->file_name);
        } else {
            // Return a 404 response if the file doesn't exist
            abort(404, 'Memo file not found.');
        }
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
