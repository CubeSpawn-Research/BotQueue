<?php namespace App\Providers;

use App\Helpers\AreaHelper;
use App\Helpers\MigrationHelper;
use Illuminate\Support\Facades\App;
use Illuminate\Support\ServiceProvider;

class AreaServiceProvider extends ServiceProvider {
	/**
	 * Register the application services.
	 *
	 * @return void
	 */
	public function register()
	{
		App::bind('area', function() {
			return new AreaHelper;
		});
	}

}
