<?php

class JobsControllerTest extends AuthTestCase
{
    protected $user;

    /** @test */
    public function it_has_the_least_possible_info()
    {
        /** @var App\Models\Job $job */
        $job = factory(App\Models\Job::class)->create();

        $this->visit('/api/jobs')
            ->seeJson([
                'id' => "{$job->id}",
                'name' => "{$job->name}",
                'status' => "available"
            ]);
    }
}
