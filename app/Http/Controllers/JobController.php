<?php

namespace App\Http\Controllers;

use App\Models\File\FileInterface;

use App\Http\Requests;
use Auth;

class JobController extends Controller
{
    public function getCreateFile(FileInterface $file)
    {
        $queues = Auth::user()->queues;
        return view('job.individual',
            compact('file', 'queues'));
    }
}
