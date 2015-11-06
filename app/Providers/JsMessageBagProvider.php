<?php

namespace App\Providers;

use App\Html\JsMessageBag;
use Illuminate\Support\ServiceProvider;

class JsMessageBagProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer(
            'app', function($view) {
            /** @var JsMessageBag $bag */
            $bag = $this->app[JsMessageBag::class];
            $view->with('js_vars', $bag->toJson());
        });
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(JsMessageBag::class, function() {
            return new JsMessageBag();
        });
    }
}
