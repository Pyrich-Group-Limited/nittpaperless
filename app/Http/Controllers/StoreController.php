<?php
namespace App\Http\Controllers;

use App\Models\Store;
use Illuminate\Http\Request;

class StoreController extends Controller
{
    public function index()
    {
        $assets = Asset::all();
        return view('assets.index', compact('assets'));
    }
}


