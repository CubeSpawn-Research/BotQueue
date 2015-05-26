<?php namespace App\Providers;

use App\Helpers\MigrationHelper;
use Illuminate\Support\Facades\App;
use Illuminate\Support\ServiceProvider;

class MigrationServiceProvider extends ServiceProvider {
	/**
	 * Register the application services.
	 *
	 * @return void
	 */
	public function register()
	{
		App::bind('migrate', function() {
			return new MigrationHelper;
		});
	}

}
