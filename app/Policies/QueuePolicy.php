<?php

namespace App\Policies;

use App\Models\Queue;
use App\User;

class QueuePolicy
{
    public function edit(User $user, Queue $queue)
    {
        return $user == $queue->user;
    }

    public function delete(User $user, Queue $queue)
    {
        return $user == $queue->user;
    }

    public function modify(User $user, Queue $queue)
    {
        return $this->edit($user, $queue) || $this->delete($user, $queue);
    }
}
