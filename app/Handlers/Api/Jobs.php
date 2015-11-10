<?php


namespace App\Handlers\Api;


use App\Helpers\Api\ApiResult;
use App\Models\Job;

class Jobs extends ApiHandler
{
    public function get()
    {
        return new ApiResult(Job::all()->toArray());
    }

    /**
     * Get the instance as an array.
     *
     * @return array
     */
    public function toArray()
    {
        return $this->get()->toArray();
    }
}