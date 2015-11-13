<?php


namespace App\Http\Api\Jobs;


use App\Helpers\Api\ApiResult;
use App\Http\Api\ApiData;

class IndexData extends ApiData
{
    public function toArray()
    {
        /** @var ApiResult $available_jobs */
        $available_jobs = api('jobs')->status('available')->get();
        /** @var ApiResult $working_jobs */
        $working_jobs = api('jobs')->status('working')->get();
        /** @var ApiResult $completed_jobs */
        $completed_jobs = api('jobs')->status('completed')->get();
        /** @var ApiResult $failed_jobs */
        $failed_jobs = api('jobs')->status('failed')->get();

        return [
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
        ];
    }
}