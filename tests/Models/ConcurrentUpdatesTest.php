<?php

use App\Exceptions\ConcurrentModificationException;
use App\Models\Job;
use App\Models\User;
use App\Models\Queue;
use App\Models\Bot;
use App\Models\File\LocalFile;

class ConcurrentUpdatesTest extends AuthTestCase
{
    /** @test */
    public function it_can_not_update_a_job_without_refreshing()
    {
        $file = factory(LocalFile::class)->create();
        $queue = factory(Queue::class)->create();

        $this->setExpectedException(ConcurrentModificationException::class);

        /** @var Job $job1 */
        $job1 = factory(Job::class)->create(compact('file', 'queue'));
        /** @var Job $job2 */
        $job2 = Job::find($job1->id);

        $job1->status = 'canceled';
        $this->assertTrue($job1->save());

        $job2->status = 'complete';
        $job2->save();
    }

    /** @test */
    public function it_can_not_update_a_user_without_refreshing()
    {
        $this->setExpectedException(ConcurrentModificationException::class);

        /** @var User $user1 */
        $user1 = User::find($this->user->id);
        /** @var User $user2 */
        $user2 = User::find($this->user->id);

        $user1->username = 'Bob';
        $this->assertTrue($user1->save());

        $user2->username = 'Alice';
        $user2->save();
    }

    /** @test */
    public function it_can_not_update_a_queue_without_refreshing()
    {
        $this->setExpectedException(ConcurrentModificationException::class);

        /** @var Queue $queue1 */
        $queue1 = factory(Queue::class)->create();
        /** @var Queue $queue2 */
        $queue2 = Queue::find($queue1->id);

        $queue1->name = 'Some Queue Name';
        $this->assertTrue($queue1->save());

        $queue2->name = 'Some Other Queue Name';
        $queue2->save();
    }

    /** @test */
    public function it_can_not_update_a_bot_without_refreshing()
    {
        $this->setExpectedException(ConcurrentModificationException::class);

        /** @var Bot $bot1 */
        $bot1 = factory(Bot::class)->create();
        /** @var Bot $bot2 */
        $bot2 = Bot::find($bot1->id);

        $bot1->status = 'idle';
        $this->assertTrue($bot1->save());

        $bot2->status = 'waiting';
        $bot2->save();
    }
}
