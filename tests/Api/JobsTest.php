<?php

use App\Models\Job;
use App\Models\Queue;
use App\Models\File\LocalFile;

class JobsTest extends AuthTestCase
{
    protected $user;

    /** @test */
    public function it_has_a_named_route()
    {
        $this->assertTrue(Route::has('api.jobs'));
    }

    /** @test */
    public function it_has_the_least_possible_info()
    {
        $file = factory(LocalFile::class)->create();
        $queue = factory(Queue::class)->create();

        /** @var Job $job */
        $job = factory(Job::class)->create(['queue' => $queue, 'file' => $file]);

        /** @var \App\Handlers\Api\Jobs\Jobs $jobs */
        $jobs = api('jobs');

        $this->assertContainsJson([
                'id' => "{$job->id}",
                'name' => "{$job->name}",
                'status' => "available"
            ], $jobs->toArray());
    }
}
