<?php


namespace App\Handlers\Api\Jobs;


use App\Handlers\Api\ApiHandler;
use App\Helpers\Api\ApiResult;
use App\Models\Job;
use \Illuminate\Database\Eloquent\Builder;
class Jobs extends ApiHandler
{
    /** @var Builder $query */
    protected $query;

    public function __construct() {
        $this->query = Job::query();
    }

    public function get()
    {
        return new ApiResult($this->query->get()->toArray());
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

    public function status($status)
    {
        return $this->singleKey('status', $status);
    }
}