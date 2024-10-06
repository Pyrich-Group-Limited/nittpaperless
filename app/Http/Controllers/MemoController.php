<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Memo;
use App\Models\MemoShare;
use App\Models\Signature;
use Auth;

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
        })->get();

        return view('memos.index', compact('memos'));
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
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'file' => 'required|mimes:pdf,doc,docx|max:2048',
        ]);

        // Handle file upload
        $filePath = $request->file('file')->store('memos');

        // Create memo
        Memo::create([
            'created_by' => Auth::id(),
            'title' => $request->title,
            'description' => $request->description,
            'file_path' => $filePath,
        ]);

        return redirect()->route('memos.index')->with('success', 'Memo created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $memo = Memo::findOrFail($id);
        $signatures = Signature::where('user_id', $memo->created_by)->first();

        return view('memos.show', compact('memo', 'signatures'));
    }

    // Share memo with another employee
    public function share(Request $request, $id)
    {
        $request->validate([
            'shared_with' => 'required|exists:users,id',
            'comment' => 'nullable',
        ]);

        MemoShare::create([
            'memo_id' => $id,
            'shared_with' => $request->shared_with,
            'shared_by' => Auth::id(),
            'comment' => $request->comment,
        ]);

        return redirect()->route('memos.show', $id)->with('success', 'Memo shared successfully.');
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
