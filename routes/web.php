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

use Illuminate\Support\Facades\Route;

Route::get('/', 'HomeController@index');

Auth::routes();

// Bot pages
Route::get('bots', 'Bot\BotController@index');

Route::get('bot/register', 'Bot\EditController@getRegister');
Route::post('bot/register', 'Bot\EditController@postRegister');

Route::get('bot/{bot}', 'Bot\BotController@view');

Route::get('bot/{bot}/delete', 'Bot\EditController@getDelete');
Route::post('bot/{bot}/delete', 'Bot\EditController@postDelete');

Route::get('bot/{bot}/edit/queues', 'Bot\EditController@getQueues');
Route::post('bot/{bot}/edit/queues', 'Bot\EditController@postQueues');

// Queue pages
Route::get('queues', 'QueueController@index');

Route::get('queue/create', 'QueueController@getCreate');
Route::post('queue/create', 'QueueController@postCreate');

Route::get('queue/{queue}', 'QueueController@view');

Route::get('queue/{queue}/edit', 'QueueController@getEdit');
Route::post('queue/{queue}/edit', 'QueueController@postEdit');

Route::get('queue/{queue}/delete', 'QueueController@getDelete');
Route::post('queue/{queue}/delete', 'QueueController@postDelete');
