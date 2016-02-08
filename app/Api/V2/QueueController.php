<?php


namespace App\Api\V2;

use App\Models\Queue;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;

class QueueController extends Controller
{
    public function index()
    {
        $jobsQuery = 'SELECT COUNT(*) FROM jobs WHERE queues.id = jobs.queue_id';
        $query = DB::table('queues')
            ->select(['id', 'name'])
            ->selectRaw("($jobsQuery AND jobs.status = 'available') as available")
            ->selectRaw("($jobsQuery AND jobs.status = 'taken') as taken")
            ->selectRaw("($jobsQuery AND jobs.status = 'failed') as failed")
            ->selectRaw("($jobsQuery AND jobs.status = 'completed') as completed")
            ->selectRaw("($jobsQuery) as total");

        return response()->json(collect($query->get())->keyBy('id')->all());
    }

    public function view(Queue $queue) {
        return $queue;
    }
}