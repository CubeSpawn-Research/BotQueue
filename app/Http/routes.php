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

$api = app('Dingo\Api\Routing\Router');

$api->version('v2', function($api) {
    /** @var $api Dingo\Api\Routing\Router */

    $api->get('version', 'App\Api\V2\MainController@version');

    $api->post('login', 'App\Api\V2\AuthController@login');
});

Route::get('/{any}', 'HomeController@index')->where('any', '.*');

//// Registration and login
//Route::get('register', 'AuthController@getLoginAndRegister');
//Route::post('register', 'AuthController@postRegister');
//
//Route::get('login', 'AuthController@getLoginAndRegister');
//Route::post('login', 'AuthController@postLogin');
//
//Route::get('logout', 'AuthController@logout');
//
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
//// Queue pages
//Route::get('queues', 'QueueController@index');
//
//Route::get('queue/create', ['as' => 'queue:create', 'uses' => 'QueueController@getCreate']);
//Route::post('queue/create', 'QueueController@postCreate');
//
//Route::get('queue/{queue}/edit', ['as' => 'queue:edit', 'uses' => 'QueueController@getEdit']);
//Route::post('queue/{queue}/edit', 'QueueController@postEdit');
//
//Route::get('queue/{queue}/delete', ['as' => 'queue:delete', 'uses' => 'QueueController@getDelete']);
//Route::post('queue/{queue}/delete', 'QueueController@postDelete');
//
//Route::get('queue/{queue}', ['as' => 'queue', 'uses' => 'QueueController@view']);
//
//// Job pages
//Route::get('jobs', 'JobController@index');
//Route::get('jobs/{status}', 'JobController@byStatus');
//
//Route::get('job/create/file/{file}', ['as' => 'job.create.file', 'uses' => 'JobController@getCreateFile']);
//Route::post('job/create/file/{file}', 'JobController@postCreateFile');