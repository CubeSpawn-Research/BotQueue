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

// Registration and login
Route::auth();

//// Upload pages
//Route::get('upload', 'UploadController@getIndex');
//Route::post('upload/file', 'UploadController@postFile');
//Route::post('upload/url', 'UploadController@postUrl');
//
//// Bot pages
//Route::get('bots', 'Bot\BotController@index');
//
//Route::get('bot/register', ['as' => 'bot:register', 'uses' => 'Bot\EditController@getRegister']);
//Route::post('bot/register', 'Bot\EditController@postRegister');
//
//Route::get('bot/{bot}/edit/queues', ['as' => 'bot:edit:queues', 'uses' => 'Bot\EditController@getQueues']);
//Route::post('bot/{bot}/edit/queues', 'Bot\EditController@postQueues');
//
//// Job pages
//Route::get('jobs', 'JobController@index');
//Route::get('jobs/{status}', 'JobController@byStatus');
//
//Route::get('job/create/file/{file}', ['as' => 'job.create.file', 'uses' => 'JobController@getCreateFile']);
//Route::post('job/create/file/{file}', 'JobController@postCreateFile');