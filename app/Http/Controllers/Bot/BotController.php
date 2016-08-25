<?php

namespace App\Http\Controllers\Bot;

use App\Models\Bot;
use App\Http\Controllers\Controller;

class BotController extends Controller
{
    public function index()
    {
        $myBots = Bot::mine()->get();

        return view('bot.index', ['bots' => $myBots]);
    }
}
