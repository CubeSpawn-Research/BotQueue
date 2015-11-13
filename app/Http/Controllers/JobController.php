<?php

namespace App\Http\Controllers;

use App\Http\Api\Jobs\IndexData as JobIndexData;
use App\Http\Requests\Job\FileRequest;
use App\Models\File\FileInterface;

use App\Http\Requests;
use App\Models\Job;
use App\Models\Queue;
use Auth;

class JobController extends Controller
{
    public function index(JobIndexData $job_data) {
        $this->js_data([
            'jobs' => $job_data
        ]);
        return view('job.index');
    }

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
            'file' => $file,
            'queue' => Queue::find($request->get('queue'))
        ]);

        dd($job);
    }
}
