<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Http\Requests\Bot\RegisterRequest;
use App\Models\Bot;
use Illuminate\Http\Request;

class BotController extends Controller {

	public function getRegister()
	{
		return view('bot.register');
	}

	public function postRegister(RegisterRequest $request)
	{
		$fields = $request->only('name', 'manufacturer', 'model');

		Bot::create($fields);
	}

}
