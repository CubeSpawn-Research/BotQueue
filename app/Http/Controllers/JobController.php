<?php

namespace App\Http\Controllers;

use App\Http\Requests\Job\FileRequest;
use App\Models\File\FileInterface;

use App\Http\Requests;
use App\Models\Job;
use Auth;

class JobController extends Controller
{
    public function index() {
        $this->js_data([
            'jobs' => [
                'available' => [
                    'data' => [],
                    'total' => 1
                ],
                'working' => [
                    'data' => [],
                    'total' => 5
                ],
                'completed' => [
                    'data' => [],
                    'total' => 9
                ],
                'failed' => [
                    'data' => [],
                    'total' => 13
                ]
            ]
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
            'file' => $file
        ]);

        dd($job);
    }
}
