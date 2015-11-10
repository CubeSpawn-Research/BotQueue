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
     * Register the application services.
     *
     * @return void
     */
    public function boot()
    {
        Route::any('{prefix}/{any}', function ($any, Request $request) {
            return $this->handle($any, $request);
        })->where(['prefix' => config('api.route.prefix'), 'any' => '.*']);
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        App::bind('api', function() {
            return new ApiHelper();
        });
    }

    public function handle($route, Request $request)
    {
        return $request->all();
        /*
        Dissect the any part to try to find the api.
        Decide if the api exists, and if it doesn't, then throw an error
        This will require splitting out the tags like {bot} before attempting to parse it.
        We should look out how the route parses that stuff to try to figure out how to match.

        api($api_match)

        Load the class up and see if a method matches.
        The method can take the request (or the all array)
        It can also take any bindings that were made for the api.
        It can also take some filter class that handles filtering on various aspects.
        I'm still not overly sure how filtering will work. For now, all of these will probably return a query builder.
        Then the filter will run on that query builder and the results will be returned.

        The results will then be convert to JSON and sent back out.
        */
    }
}
