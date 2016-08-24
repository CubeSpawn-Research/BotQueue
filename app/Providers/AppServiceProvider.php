<?php

namespace App\Providers;

use App\Models\Bot;
use App\Models\File\LocalFile;
use App\Models\Job;
use App\Models\Observers\JobObserver;
use App\Models\Observers\LocalFileObserver;
use App\Models\Observers\QueueObserver;
use App\Models\Queue;
use Illuminate\Support\ServiceProvider;
use App\Models\Observers\BotObserver;
use Validator;

class AppServiceProvider extends ServiceProvider
{

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Validator::extend('access', function ($attribute, $value, $parameters) {
            if (!is_array($value))
                $value = [$value];

            $model = $parameters[0];
            $scope = $parameters[1];

            $count = app()->make($model)->$scope()->findMany($value)->count();
            return $count === count($value);
        });

        Bot::observe(new BotObserver);
        Job::observe(new JobObserver);
        LocalFile::observe(new LocalFileObserver);
        Queue::observe(new QueueObserver);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

}
