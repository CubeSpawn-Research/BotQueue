<?php

namespace App\Http\Controllers;

use App\Http\Requests\Upload\FileRequest;

use App\Http\Requests;
use App\Models\File\LocalFile;

class UploadController extends Controller
{
    public function getIndex()
    {
        return view('upload.index');
    }

    public function postFile(FileRequest $request)
    {
        $uploaded = $request->file('file');

        $file = LocalFile::make($uploaded, $uploaded->getClientOriginalName());
        dd($file);
    }
}
