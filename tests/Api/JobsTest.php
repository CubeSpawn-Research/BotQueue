<?php

use App\Models\Job;
use Illuminate\Database\Eloquent\Collection;

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

    /** @test */
    public function it_can_limit_by_status()
    {
        factory(Job::class, 3)->create(['status' => 'available']);
        factory(Job::class, 5)->create(['status' => 'taken']);

        $this->assertCount(8, api('jobs')->get()->data);

        $this->assertCount(3, api('jobs')->status('available')->get());

        $this->assertCount(5, api('jobs')->status('taken')->get());

        $this->assertCount(8, api('jobs')->status(['available', 'taken'])->get());

        $this->assertCount(8, api('jobs')->status('available')->status('taken')->get());
    }
}
