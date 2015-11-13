<?php

use App\Models\Job;

class JobsTest extends AuthTestCase
{
    protected $user;

    /** @test */
    public function it_has_the_least_possible_info()
    {
        /** @var Job $job */
        $job = factory(Job::class)->create();

        /** @var App\Handlers\Api\Jobs $jobs */
        $jobs = api('jobs');

        $this->assertContainsJson([
                'id' => "{$job->id}",
                'name' => "{$job->name}",
                'status' => "available"
            ], $jobs->toArray());
    }
}
