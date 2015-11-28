<?php

namespace App\Providers;

use App;
use App\Helpers\Api\ApiHelper;
use Illuminate\Http\Request;
use Illuminate\Support\ServiceProvider;
use Route;

class ApiServiceProvider extends ServiceProvider
{

    /**
     * ApiServiceProvider constructor.
     * @param \Illuminate\Contracts\Foundation\Application $app
     */
    public function __construct($app) {
        parent::__construct($app);

        $this->prefix = config('api.route.prefix');
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function boot()
    {
        foreach(config('api.endpoints') AS $endpoint => $class) {
            $this->registerEndpoint($endpoint, $class);
        }
    }

    private function registerEndpoint($endpoint, $class)
    {
        // Get route name
        // Get route path
        // Register any path
        Route::any($this->prefix.'/'. $this->getPath($endpoint),
            ['as' => 'api.'.$endpoint, function(Request $request) use ($class) {
                $object = app()->make($class);
                switch($request->method()) {
                    case 'GET':
                        return $object->get();
                        break;
                }

                $apiResult = new App\Helpers\Api\ApiResult("That endpoint doesn't seem to exist");
                return $apiResult->fail();
        }]);
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('api', function() {
            return new ApiHelper();
        });
    }

    /**
     * @param $endpoint
     * @return mixed
     */
    private function getPath($endpoint)
    {
        return str_replace('.', '/', $endpoint);
    }
}
