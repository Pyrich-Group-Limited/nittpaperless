<?php

namespace App\Http\Controllers\FileManagement;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FilesController extends Controller
{
    public function filesIndex(Request $request){
        return view('filemanagement.index');
    }

    public function filesUpload(Request $request){
        return view('filemanagement.modals.uploadfile');
    }

    public function createFile(Request $request){
        return view('filemanagement.modals.create-file');
    }

    public function createFolder(Request $request){
        return view('filemanagement.modals.create-folder');
    }
}
