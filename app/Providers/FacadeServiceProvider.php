<?php namespace App\Providers;

use App;
use App\Helpers\AreaHelper;
use App\Helpers\FileUtilsHelper;
use App\Helpers\MigrationHelper;
use Illuminate\Support\ServiceProvider;

class FacadeServiceProvider extends ServiceProvider
{
    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        App::bind('area', function () {
            return new AreaHelper;
        });

        App::bind('migrate', function () {
            return new MigrationHelper;
        });

        App::bind('file_utils', function() {
            return new FileUtilsHelper;
        });
    }

}
