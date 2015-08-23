<?php namespace App\Http\Controllers\Bot;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Http\Requests\Bot\RegisterRequest;
use App\Models\Bot;
use Html\Wizards\Wizard;
use Illuminate\Http\Request;

class EditController extends Controller
{

    public function getRegister()
    {
        return view('bot.edit.register');
    }

    public function postRegister(RegisterRequest $request)
    {
        $fields = $request->only('name', 'manufacturer', 'model');

        $bot = Bot::create($fields);

        return redirect()->route('bot:edit:queues', [$bot]);
    }

    public function getQueues(Bot $bot)
    {
        return view('bot.edit.queues');
    }
}
