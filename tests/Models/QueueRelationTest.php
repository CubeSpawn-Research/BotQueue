<?php

use App\Models\Queue;

class QueueRelationTest extends AuthTestCase
{
    /** @var Queue $queue */
    protected $queue;

    public function setUp()
    {
        parent::setUp();
        $this->queue = factory(Queue::class)->create();
    }

    /** @test */
    public function the_queue_has_jobs()
    {
        $jobs = factory(App\Models\Job::class, 5)->create();
        $this->queue->jobs()->saveMany($jobs);

        $this->assertCount(5, $this->queue->jobs);
    }
}
