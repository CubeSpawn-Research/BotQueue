<?php


namespace App\Handlers\Api\Queues;


use App\Handlers\Api\ApiHandler;
use App\Helpers\Api\ApiResult;
use App\Models\Job;
use App\Models\Queue;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;

class Jobs extends ApiHandler
{
    public function __construct()
    {
        $jobsQuery = 'SELECT COUNT(*) FROM jobs WHERE queues.id = jobs.queue_id';
        $this->query = DB::table('queues')
            ->select(['id', 'name'])
            ->selectRaw("($jobsQuery AND jobs.status = 'available') as available")
            ->selectRaw("($jobsQuery AND jobs.status = 'taken') as taken")
            ->selectRaw("($jobsQuery AND jobs.status = 'failed') as failed")
            ->selectRaw("($jobsQuery AND jobs.status = 'completed') as completed")
            ->selectRaw("($jobsQuery) as total")
        ;
        /**
         * SELECT  q.id,
        (SELECT COUNT(*) FROM jobs j WHERE q.id = j.queue_id AND j.status = 'available') as available,
        (SELECT COUNT(*) FROM jobs j WHERE q.id = j.queue_id AND j.status = 'taken') as taken,
        (SELECT COUNT(*) FROM jobs j WHERE q.id = j.queue_id AND j.status = 'failed') as failed,
        (SELECT COUNT(*) FROM jobs j WHERE q.id = j.queue_id AND j.status = 'complete') as complete,
        (SELECT COUNT(*) FROM jobs j WHERE q.id = j.queue_id) as total
        FROM queues q
         */
    }

    public function get()
    {
        $result = collect($this->query->get())->keyBy('id')->all();
        return new ApiResult($result);
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