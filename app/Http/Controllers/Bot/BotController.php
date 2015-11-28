<?php

namespace App\Http\Controllers\Bot;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class BotController extends Controller
{
    public function index()
    {
        js_data([
            'bots' => [
                [
                    'name' => 'test',
                    'status' => 'idle',
                    'last_seen' => 'um'
                ],
                [
                    'name' => 'abc',
                    'status' => 'offline',
                    'last_seen' => 'haha'
                ]
            ]
        ]);

        return view('bot.index');
    }
}
