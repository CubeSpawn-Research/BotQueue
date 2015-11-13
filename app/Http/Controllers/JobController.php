<?php

namespace App\Http\Controllers;

use App\Helpers\Api\ApiResult;
use App\Http\Requests\Job\FileRequest;
use App\Models\File\FileInterface;

use App\Http\Requests;
use App\Models\Job;
use App\Models\Queue;
use Auth;

class JobController extends Controller
{
    public function index() {
        /** @var ApiResult $available_jobs */
        $available_jobs = api('jobs')->status('available')->get();
        /** @var ApiResult $working_jobs */
        $working_jobs = api('jobs')->status('working')->get();
        /** @var ApiResult $completed_jobs */
        $completed_jobs = api('jobs')->status('completed')->get();
        /** @var ApiResult $failed_jobs */
        $failed_jobs = api('jobs')->status('failed')->get();

        $this->js_data([
            'jobs' => [
                'available' => [
                    'jobs' => $available_jobs,
                    'count' => $available_jobs->count()
                ],
                'working' => [
                    'jobs' => $working_jobs,
                    'count' => $working_jobs->count()
                ],
                'completed' => [
                    'jobs' => $completed_jobs,
                    'count' => $completed_jobs->count()
                ],
                'failed' => [
                    'jobs' => $failed_jobs,
                    'count' => $failed_jobs->count()
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
            'file' => $file,
            'queue' => Queue::find($request->get('queue'))
        ]);

        dd($job);
    }
}
