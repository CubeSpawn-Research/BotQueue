<?php

use App\Handlers\Api\Queues\Jobs;
use App\Models\Queue;
use App\Models\Job;
use App\Models\File\LocalFile;

class QueueJobsTest extends AuthTestCase
{
    /** @test */
    public function it_has_a_named_route()
    {
        $this->assertTrue(Route::has('api.queues.jobs'));

        $uri = Route::getRoutes()->getByName('api.queues.jobs')->getUri();
        $this->assertEquals('api/queues/jobs', $uri);
    }

    /** @test */
    public function it_can_retrieve_no_queues()
    {
        /** @var Jobs $api */
        $api = api('queues.jobs');

        $this->assertEquals(0, Queue::all()->count());

        $this->assertEquals([], $api->toArray());
    }

    /** @test */
    public function it_can_retrieve_two_queues_with_no_jobs()
    {
        $queues = factory(Queue::class, 2)->create();
        $this->assertEquals(2, Queue::all()->count());

        /** @var Jobs $api */
        $api = api('queues.jobs');
        $this->assertNotNull($api->get());
        $result = $api->toArray();

        foreach ($queues as $queue) {
            /** @var Queue $queue */
            $this->assertContainsJson([
                'name' => $queue->name
            ], $result);
        }
    }

    /** @test */
    public function it_can_retrieve_one_queue_with_1_available_job()
    {
        $queue = factory(Queue::class)->create();

        $file = factory(LocalFile::class)->create();

        factory(Job::class)->create(compact('file', 'queue'));

        /** @var Jobs $api */
        $api = api('queues.jobs');
        $this->assertNotNull($api->get());
        $result = $api->toArray();

        $counts = $result[$queue->id];

        $this->assertEquals($queue->name, $counts->name);
        $this->assertEquals(1, $counts->available);
        $this->assertEquals(0, $counts->taken);
        $this->assertEquals(0, $counts->failed);
        $this->assertEquals(0, $counts->completed);
        $this->assertEquals(1, $counts->total);
    }

    /** @test */
    public function it_can_retrieve_one_queue_with_1_taken_job()
    {
        $queue = factory(Queue::class)->create();

        $file = factory(LocalFile::class)->create();

        factory(Job::class)->create(['file' => $file, 'queue' => $queue, 'status' => 'taken']);

        /** @var Jobs $api */
        $api = api('queues.jobs');
        $this->assertNotNull($api->get());
        $result = $api->toArray();

        $counts = $result[$queue->id];

        $this->assertEquals($queue->name, $counts->name);
        $this->assertEquals(0, $counts->available);
        $this->assertEquals(1, $counts->taken);
        $this->assertEquals(0, $counts->failed);
        $this->assertEquals(0, $counts->completed);
        $this->assertEquals(1, $counts->total);
    }

    /** @test */
    public function it_can_retrieve_one_queue_with_1_failed_job()
    {
        $queue = factory(Queue::class)->create();

        $file = factory(LocalFile::class)->create();

        factory(Job::class)->create(['file' => $file, 'queue' => $queue, 'status' => 'failed']);

        /** @var Jobs $api */
        $api = api('queues.jobs');
        $this->assertNotNull($api->get());
        $result = $api->toArray();

        $counts = $result[$queue->id];

        $this->assertEquals($queue->name, $counts->name);
        $this->assertEquals(0, $counts->available);
        $this->assertEquals(0, $counts->taken);
        $this->assertEquals(1, $counts->failed);
        $this->assertEquals(0, $counts->completed);
        $this->assertEquals(1, $counts->total);
    }

    /** @test */
    public function it_can_retrieve_one_queue_with_1_completed_job()
    {
        $queue = factory(Queue::class)->create();

        $file = factory(LocalFile::class)->create();

        factory(Job::class)->create(['file' => $file, 'queue' => $queue, 'status' => 'completed']);

        /** @var Jobs $api */
        $api = api('queues.jobs');
        $this->assertNotNull($api->get());
        $result = $api->toArray();

        $counts = $result[$queue->id];

        $this->assertEquals($queue->name, $counts->name);
        $this->assertEquals(0, $counts->available);
        $this->assertEquals(0, $counts->taken);
        $this->assertEquals(0, $counts->failed);
        $this->assertEquals(1, $counts->completed);
        $this->assertEquals(1, $counts->total);
    }

    /** @test */
    public function it_can_retrieve_one_queue_with_different_job_statuses()
    {
        $queue = factory(Queue::class)->create();

        $file = factory(LocalFile::class)->create();

        factory(Job::class, 2)->create(['file' => $file, 'queue' => $queue, 'status' => 'available']);
        factory(Job::class, 3)->create(['file' => $file, 'queue' => $queue, 'status' => 'taken']);
        factory(Job::class, 5)->create(['file' => $file, 'queue' => $queue, 'status' => 'failed']);
        factory(Job::class, 7)->create(['file' => $file, 'queue' => $queue, 'status' => 'completed']);

        /** @var Jobs $api */
        $api = api('queues.jobs');
        $this->assertNotNull($api->get());
        $result = $api->toArray();

        $counts = $result[$queue->id];

        $this->assertEquals($queue->name, $counts->name);
        $this->assertEquals(2, $counts->available);
        $this->assertEquals(3, $counts->taken);
        $this->assertEquals(5, $counts->failed);
        $this->assertEquals(7, $counts->completed);
        $this->assertEquals(17, $counts->total);
    }
}
