<?php

namespace App\Http\Controllers;

use App\Http\Requests\Job\FileRequest;
use App\Models\File\FileInterface;

use App\Http\Requests;
use App\Models\Job;
use Auth;

class JobController extends Controller
{
    public function getCreateFile(FileInterface $file)
    {
        $queues = Auth::user()->queues;
        return view('job.individual',
            compact('file', 'queues'));
    }

    public function postCreateFile(FileRequest $request,
                                   FileInterface $file)
    {
        $job = Job::create([
            'name' => $request->get('name'),
            'file' => $file
        ]);

        dd($job);
    }
}
