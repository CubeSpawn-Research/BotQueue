<?php namespace App\Providers;

use App\Models\Bot;
use App\Models\Observers\QueueObserver;
use App\Models\Queue;
use Illuminate\Support\ServiceProvider;
use App\Models\Observers\BotObserver;

class AppServiceProvider extends ServiceProvider {

	/**
	 * Bootstrap any application services.
	 *
	 * @return void
	 */
	public function boot()
	{
		Bot::observe(new BotObserver);
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
