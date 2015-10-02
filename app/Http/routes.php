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
Route::get('about', 'InfoController@about');

// Registration and login
Route::get('register', 'AuthController@getLoginAndRegister');
Route::post('register', 'AuthController@postRegister');

Route::get('login', 'AuthController@getLoginAndRegister');
Route::post('login', 'AuthController@postLogin');

Route::get('logout', 'AuthController@logout');

// Upload pages
Route::get('upload', 'UploadController@getIndex');

// Bot pages
Route::get('bot/register', ['as' => 'bot:register', 'uses' => 'Bot\EditController@getRegister']);
Route::post('bot/register', 'Bot\EditController@postRegister');

Route::get('bot/{bot}/edit/queues', ['as' => 'bot:edit:queues', 'uses' => 'Bot\EditController@getQueues']);
Route::post('bot/{bot}/edit/queues', 'Bot\EditController@postQueues');

// Queue pages
Route::get('queues', 'QueueController@index');

Route::get('queue/create', ['as' => 'queue:create', 'uses' => 'QueueController@getCreate']);
Route::post('queue/create', 'QueueController@postCreate');

Route::get('queue/{queue}/edit', ['as' => 'queue:edit', 'uses' => 'QueueController@getEdit']);
Route::post('queue/{queue}/edit', 'QueueController@postEdit');

Route::get('queue/{queue}/delete', ['as' => 'queue:delete', 'uses' => 'QueueController@getDelete']);
Route::post('queue/{queue}/delete', 'QueueController@postDelete');

Route::get('queue/{queue}', ['as' => 'queue', 'uses' => 'QueueController@view']);