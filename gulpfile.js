var elixir = require('laravel-elixir');

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Less
 | file for our application, as well as publishing vendor resources.
 |
 */

elixir(function (mix) {
    mix.phpUnit();

    mix.sass([
        'signin.scss',
        'dragula.scss',
        'botqueue.scss'
    ], 'public/css');

    mix.browserify('main.js',
        'public/js/build.js', 'resources/assets/vue');
});
