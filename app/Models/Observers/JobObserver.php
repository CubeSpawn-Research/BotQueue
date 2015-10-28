<?php


namespace App\Models\Observers;


use Illuminate\Support\Facades\Auth;

class JobObserver
{

    public function creating($job)
    {
        // The user must be logged in to create a job
        if (!Auth::check())
            return false;

        $job->user()->associate(Auth::user());
        $job->temperature_data = json_encode([]);

        return true;
    }
}