<?php

namespace App\Policies;

use App\Models\Queue;
use App\Models\User;

class QueuePolicy
{
    public function edit(User $user, Queue $queue)
    {
        return false;
    }

    public function delete(User $user, Queue $queue)
    {
        return false;
    }

    public function modify(User $user, Queue $queue)
    {
        return $this->edit($user, $queue) || $this->edit($user, $queue);
    }
}
