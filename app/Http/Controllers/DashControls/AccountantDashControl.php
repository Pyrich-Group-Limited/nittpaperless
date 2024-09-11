<?php

namespace App\Http\Controllers\DashControls;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ProductService;
use App\Models\ProductServiceCategory;

class AccountantDashControl extends Controller
{
    public function index(Request $request)
    {
        return view('accountant.set-budget-index');
    }

    public function purchase(Request $request){
        return view('accountant.purchase-requisition');
    }

    public function storeReq(Request $request){
        return view('accountant.store-requisition');
    }

    public function leave(Request $request){
        return view('accountant.leave');
    }
}
