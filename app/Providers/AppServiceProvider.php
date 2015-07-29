<?php namespace App\Providers;

use App\Models\Bot;
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
