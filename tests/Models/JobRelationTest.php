<?php

use App\Models\Job;
use App\Models\Queue;
use App\Models\File\LocalFile;

class JobRelationTest extends AuthTestCase
{
    /** @var App\Models\Job $job */
    protected $job;

    public function setUp()
    {
        parent::setUp();

        $file = factory(LocalFile::class)->create();
        $queue = factory(Queue::class)->create(['user' => $this->user]);

        $this->job = factory(App\Models\Job::class)->create(compact('file', 'queue'));
    }

    /** @test */
    public function the_queue_relation_is_correct()
    {
        $this->assertNotNull($this->job->queue);
        $this->assertEquals($this->job->queue_id, $this->job->queue->id);
    }

    /** @test */
    public function the_file_relation_is_correct()
    {
        $this->assertNotNull($this->job->file);
        $this->assertEquals($this->job->file_id, $this->job->file->id);
    }

    /** @test */
    public function the_user_relation_is_correct()
    {
        $this->assertNotNull($this->job->user);
        $this->assertEquals($this->job->user_id, $this->job->user->id);
    }
}
