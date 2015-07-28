<?php namespace App\Http\Controllers;

use App\Http\Requests;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Contracts\Auth\Guard;

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
		$this->middleware('guest', ['except' => ['logout']]);
	}

	public function getRegister()
	{
		return view('auth.register');
	}

	public function postRegister(RegisterRequest $request)
	{
		$credentials = $request->only('username', 'email', 'password');
		$user = User::create([
			'username' => $credentials['username'],
			'email'    => $credentials['email'],
			'password' => $credentials['password']
		                     ]);

		$this->auth->login($user, true);

		return redirect('/');
	}

	public function getLogin()
	{
		return view('auth.login');
	}

	public function postLogin(LoginRequest $request)
	{
		$credentials = $request->only('username', 'password');

		if ($this->auth->attempt($credentials, $request->has('remember_me')))
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

	public function logout()
	{
		$this->auth->logout();
		return redirect('/');
	}

}
