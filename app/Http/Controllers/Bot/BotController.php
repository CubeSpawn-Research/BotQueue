<?php

namespace App\Http\Controllers\Bot;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class BotController extends Controller
{
    public function index()
    {
        js_data(['bots' => api('bots')->toArray()]);

        return view('bot.index');
    }
}
