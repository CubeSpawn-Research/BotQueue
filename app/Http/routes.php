<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', 'HomeController@index');
Route::get('home', 'HomeController@index');

// Registration and login
Route::get('register', 'AuthController@getLoginAndRegister');
Route::post('register', 'AuthController@postRegister');
Route::get('login', 'AuthController@getLoginAndRegister');
Route::post('login', 'AuthController@postLogin');
Route::get('logout', 'AuthController@logout');

Route::group([
    'as' => 'bot:',
    'namespace' => 'Bot',
    'prefix' => 'bot'
], function () {
    Route::get('register', ['as' => 'register', 'uses' => 'EditController@getRegister']);
    Route::post('register', 'EditController@postRegister');
});

Route::group([
    'as' => 'bot:',
    'namespace' => 'Bot',
    'prefix' => 'bot/{bot}'
], function () {
    Route::group([
        'as' => 'edit:',
        'prefix' => 'edit'
    ], function () {
        Route::get('queues', ['as' => 'queues', 'uses' => 'EditController@getQueues']);
    });
});

Route::get('about', 'InfoController@about');