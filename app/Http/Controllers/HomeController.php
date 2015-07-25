<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller {

	public function index()
	{
		if(Auth::check()) {
			return view('home.index');
		}

		return view('home.welcome');
	}

}
