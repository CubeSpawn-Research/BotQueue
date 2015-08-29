<?php

namespace App\Http\Controllers;

use App\Http\Requests\Queue\CreateRequest;
use App\Models\Queue;

use App\Http\Requests;
use Area;
use Auth;

class QueueController extends Controller
{
    public function __construct()
    {
        Area::is('queues');
    }

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

    public function index()
    {
        $queues = Auth::user()->queues()->paginate(20);

        return view('queue.index', compact('queues'));
    }
}
