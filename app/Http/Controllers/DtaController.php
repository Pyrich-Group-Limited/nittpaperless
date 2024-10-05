<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Dta;
use App\Models\DtaApproval;
use App\Models\User;
use App\Models\DtaRejectionComment;

class DtaController extends Controller
{
    // Show dta request status
    public function index()
    {
        if(auth()->user()->type=='unit head' || auth()->user()->type=='supervisor'){
            $dtaRequests = Dta::where('current_approver','Unit Head')->orWhere('user_id', auth()->id())->orderBy('status','DESC')->with('approval', 'rejectionComment')->get();
        }elseif(auth()->user()->type=='liason office head' || auth()->user()->type=='HOD'){
            $dtaRequests = Dta::where('current_approver','HOD')->orWhere('user_id', auth()->id())->orderBy('status','DESC')->with('approval', 'rejectionComment')->get();

        }elseif(auth()->user()->type=='accountant'){
            $dtaRequests = Dta::where('current_approver','Bursary/Accountant')->orWhere('user_id', auth()->id())->orderBy('status','DESC')->with('approval', 'rejectionComment')->get();
        }else{
            $dtaRequests = Dta::where('user_id', auth()->id())->orderBy('status','DESC')->with('approval', 'rejectionComment')->get();
        }
        return view('dta.index', compact('dtaRequests'));
    }

    // Show form to create a dta request
    public function create()
    {
        return view('dta.create');
    }

    // Store dta request
    public function store(Request $request)
    {
        $request->validate([
            'purpose' => 'required|string|max:500',
            'destination' => 'required|string|max:255',
            'travel_date' => 'required|date|max:255',
            'arrival_date' => 'required|date|max:255',
            'expense' => 'required|numeric|min:0',
        ]);

        $dtaRequest = Dta::create([
            'user_id' => auth()->id(),
            'purpose' => $request->purpose,
            'destination' => $request->destination,
            'travel_date' => $request->travel_date,
            'arrival_date' => $request->arrival_date,
            'estimated_expense' => $request->expense,
            'current_approver' => 'Unit Head',
        ]);

        // Create an approval record
        DtaApproval::create(['dta_id' => $dtaRequest->id]);

        return redirect()->route('dta.index')->with('success', 'DTA request submitted successfully.');
    }

    // Supervisor approval
    // public function approveBySupervisor($id)
    // {
    //     $approval = DtaApproval::where('dta_id', $id)->first();
    //     $travelRequest = Dta::find($id);

    //     if ($approval->approved_by_supervisor) {
    //         return redirect()->back()->with('error','Already approved by Supervisor.');
    //     }
    //     $approval->approved_by_supervisor = true;
    //     $approval->save();
    //     $travelRequest->current_approver = 'Unit Head';
    //     $travelRequest->save();
    //     return redirect()->route('dta.index')->with('success', 'Request approved by Supervisor.');
    // }

    // Unit Head approval
    public function approveByUnitHead($id)
    {
        $approval = DtaApproval::where('dta_id', $id)->first();
        $travelRequest = Dta::find($id);

        if ($approval->approved_by_unit_head) {
            return redirect()->back()->with('error','Already approved by Unit Head.');
        }

        $approval->approved_by_unit_head = true;
        $approval->save();

        // Set next approver as Unit Head
        $travelRequest->current_approver = 'HOD';
        $travelRequest->save();

        return redirect()->route('dta.index')->with('success', 'Request approved by Unit Head.');
    }

    // HOD approval
    public function approveByHod($id)
    {
        $approval = DtaApproval::where('dta_id', $id)->first();
        $travelRequest = Dta::find($id);

        if ($approval->approved_by_hod) {
            return redirect()->back()->with('error','Already approved by Head of Department.');
        }

        $approval->approved_by_hod = true;
        $approval->save();

        // Set next approver as Bursary
        $travelRequest->current_approver = 'Bursary/Accountant';
        $travelRequest->save();

        return redirect()->route('dta.index')->with('success', 'Request approved by H.O.D.');
    }

    // Bursary / Accountant approval
    public function approveByAccountant($id)
    {
        $approval = DtaApproval::where('dta_id', $id)->first();
        $travelRequest = Dta::find($id);

        if ($approval->approved_by_accountant) {
            return redirect()->back()->with('error','Already approved by Bursary/Accountant.');
        }

        $approval->approved_by_accountant = true;
        $approval->save();

        // Set next approver as Unit Head
        $travelRequest->current_approver = 'Approved';
        $travelRequest->status = 'Approved';
        $travelRequest->save();

        return redirect()->route('dta.index')->with('success', 'DTA Request fully approved');
    }

    public function reject($id){
        $dtaReject = Dta::find($id);

        return view('dta.reject',compact('dtaReject'));
    }

    // Rejection by any stage
    public function rejectRequest(Request $request, $id)
    {
        $request->validate([
            'comment' => 'required|string',
        ]);

        $travelRequest = Dta::find($id);
        $travelRequest->status = 'rejected';
        $travelRequest->save();

        // Log rejection comment
        DtaRejectionComment::create([
            'dta_id' => $travelRequest->id,
            'rejected_by' => auth()->id(),
            'comment' => $request->comment,
        ]);

        return redirect()->route('dta.index')->with('success', 'Request rejected with comment.');
    }

    public function showRejected($id){
        $rejectedDta = Dta::find($id);

        return view('dta.rejected',compact('rejectedDta'));
    }


    public function show(Request $request, $id)
    {
        $dta = Dta::find($id);
        return view('dta.show',compact('dta'));
    }

}
