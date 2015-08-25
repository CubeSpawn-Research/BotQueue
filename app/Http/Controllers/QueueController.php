<?php

namespace App\Http\Controllers;

use App\Http\Requests\Queue\CreateRequest;
use App\Models\Queue;

use App\Http\Requests;

class QueueController extends Controller
{
    public function getCreate()
    {
        return view('queue.create');
    }

    public function postCreate(CreateRequest $request)
    {
        $fields = $request->only('name', 'delay');

        Queue::create($fields);

        // todo-laravel Redirect to the queue's page

        return redirect('/');
    }
}
