<?php namespace App\Http\Controllers\Bot;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Http\Requests\Bot\QueueRequest;
use App\Http\Requests\Bot\RegisterRequest;
use App\Models\Bot;
use Auth;

class EditController extends Controller
{

    public function getRegister()
    {
        return view('bot.edit.register');
    }

    public function postRegister(RegisterRequest $request)
    {
        $fields = $request->only('name', 'type');

        $bot = Bot::create($fields);

        return redirect()->route('bot:edit:queues', [$bot]);
    }

    public function getQueues(Bot $bot)
    {
        $queues = $bot->queues;
        $ignored = Auth::user()->queues->diff($queues);

        return view('bot.edit.queues', compact('bot', 'queues', 'ignored'));
    }

    public function postQueues(Bot $bot, QueueRequest $request)
    {
        $queues = $request->get('queues');

        $bot->queues()->sync($queues);

        return redirect('/bots');
    }
}
