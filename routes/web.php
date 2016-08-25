<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', 'HomeController@index');

Auth::routes();

// Queue pages
Route::get('queues', 'QueueController@index');

Route::get('queue/create', ['as' => 'queue:create', 'uses' => 'QueueController@getCreate']);
Route::post('queue/create', 'QueueController@postCreate');

Route::get('queue/{queue}/edit', ['as' => 'queue:edit', 'uses' => 'QueueController@getEdit']);
Route::post('queue/{queue}/edit', 'QueueController@postEdit');

Route::get('queue/{queue}/delete', ['as' => 'queue:delete', 'uses' => 'QueueController@getDelete']);
Route::post('queue/{queue}/delete', 'QueueController@postDelete');

Route::get('queue/{queue}', ['as' => 'queue', 'uses' => 'QueueController@view']);