<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Contracts\Auth\Guard;
use Illuminate\Http\Request;

class AuthController extends Controller {

	/**
	 * The Guard implementation.
	 *
	 * @var \Illuminate\Contracts\Auth\Guard
	 */
	protected $auth;

	public function __construct(Guard $guard)
	{
	    $this->auth = $guard;
	}

	public function getLogin()
	{
		return view('auth.login');
	}

	public function postLogin(Request $request)
	{
		$this->validate($request, [
			'username' => 'required',
			'password' => 'required'
		]);

		$credentials = $request->only('username', 'password');

		if ($this->auth->attempt($credentials, $request->has('remember')))
		{
			return redirect()->intended('/');
		}

		return redirect('/login')
			->withInput($request->only('username', 'remember'))
			->withErrors([
				             'username' => $this->getFailedLoginMessage(),
			             ]);
	}

	private function getFailedLoginMessage()
	{
		return "I'm sorry, but I couldn't log you in";
	}

}
