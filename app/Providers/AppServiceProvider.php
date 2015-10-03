<?php namespace App\Providers;

use App\Models\Bot;
use App\Models\File\LocalFile;
use App\Models\Observers\LocalFileObserver;
use App\Models\Observers\QueueObserver;
use App\Models\Queue;
use Illuminate\Support\ServiceProvider;
use App\Models\Observers\BotObserver;
use Validator;

class AppServiceProvider extends ServiceProvider {

	/**
	 * Bootstrap any application services.
	 *
	 * @return void
	 */
	public function boot()
	{
        Validator::extend('access', function($attribute, $value, $parameters) {
            if(!is_array($value))
                $value = [$value];

            $model = $parameters[0];
            $scope = $parameters[1];

            $count = app()->make($model)->$scope()->findMany($value)->count();
            return $count === count($value);
        });

		Bot::observe(new BotObserver);
		Queue::observe(new QueueObserver);
		LocalFile::observe(new LocalFileObserver);
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
