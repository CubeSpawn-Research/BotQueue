<?php

use App\Models\Queue;
use App\Models\File\LocalFile;

class QueueRelationTest extends AuthTestCase
{
    /** @var Queue $queue */
    protected $queue;

    public function setUp()
    {
        parent::setUp();
        $this->queue = factory(Queue::class)->create(['user' => $this->user]);
    }

    /** @test */
    public function the_queue_has_jobs()
    {
        $file = factory(LocalFile::class)->create();
        $queue = factory(Queue::class)->create(['user' => $this->user]);

        $jobs = factory(App\Models\Job::class, 5)->create(compact('file', 'queue'));
        $this->queue->jobs()->saveMany($jobs);

        $this->assertCount(5, $this->queue->jobs);
    }
}
