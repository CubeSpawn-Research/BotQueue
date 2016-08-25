<?php


namespace App\Models\Observers;


use App\Models\Queue;
use App\User;

class UserObserver
{
    /**
     * @param User $user
     * @return bool
     */
    public function created(User $user)
    {
        $queue = new Queue(['name' => 'Default', 'delay' => 0]);
        $queue->user = $user;
        $queue->save();
    }
}