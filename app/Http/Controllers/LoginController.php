<?php


namespace App\Http\Controllers;


use App\Http\Controllers\Controller;
use App\Http\Managers\UserManager;
use App\Http\Requests\LoginRequest;
use Illuminate\Http\Response;

class LoginController extends Controller
{
    public function __invoke(LoginRequest $request)
    {
        $email = $request->input('email');
        $password = $request->input('password');

        $userManager = app(UserManager::class);
        $token = $userManager->auth($email, $password);
        if ($token === 0) {
            return response()->json(['error' => 'Почта не зарегистрирована'], 401);
        }
        if ($token === 1) {
            return response()->json(['error' => 'Пароль неверный'], 401);
        }

        return (new Response(['Authorization', 'Bearer ' . $token], 200))->header('Access-Control-Allow-Origin', '*');
        }
}
