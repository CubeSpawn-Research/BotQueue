<?php


namespace App\Api\V2;

use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Models\User;
use Dingo\Api\Routing\Helpers;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Routing\Controller;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{
    use Helpers;

    protected $guard;

    public function __construct(Guard $guard)
    {
        $this->guard = $guard;
    }

    public function register(RegisterRequest $request)
    {
        $credentials = $request->only('username', 'email', 'password');

        $user = User::create($credentials);

        $token = JWTAuth::fromUser($user, ['username' => $user->username]);

        return response()->json(['token' => $token, 'username' => $user->username]);
    }

    public function login(LoginRequest $request)
    {
        $credentials = $request->only('username', 'password');

        $loggedIn = $this->guard->once($credentials);

        if(! $loggedIn) {
            return response()->json(['error' => 'invalid_credentials'], 401);
        }

        /** @var User $user */
        $user = $this->guard->user();

        $token = JWTAuth::fromUser($user, ['username' => $user->username]);

        return response()->json(['token' => $token, 'username' => $user->username]);
    }
}