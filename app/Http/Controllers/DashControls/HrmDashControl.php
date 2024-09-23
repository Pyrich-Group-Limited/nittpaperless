<?php

namespace App\Http\Controllers\DashControls;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HrmDashControl extends Controller
{
    public function budget(Request $request)
    {
        return view('hrm.budget');
    }

    public function hrmQuery(Request $request)
    {
        return view('hrm.query');
    }

    public function hrmLeave(Request $request)
    {
        return view('hrm.leave');
    }
    public function hrmDta(Request $request)
    {
        return view('hrm.dta');
    }
    public function hrmMemo(Request $request)
    {
        return view('hrm.memo');
    }

    public function applyLeave(Request $request)
    {
        return view('hrm.modals.apply-leave');
    }

    public function applyQuery(Request $request)
    {
        return view('hrm.modals.apply-query');
    }

    public function applyDta(Request $request)
    {
        return view('hrm.modals.apply-dta');
    }
}
