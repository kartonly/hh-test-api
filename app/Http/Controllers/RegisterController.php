<?php


namespace App\Http\Controllers;


use App\Http\Controllers\Controller;
use App\Http\Managers\UserManager;
use App\Http\Requests\RegisterRequest;
use Illuminate\Http\Response;
use Illuminate\Support\Str;

class RegisterController extends Controller
{
    public function reg(RegisterRequest $request){
        $email = $request['email'];
        $password = $request['password'];

        $userManager = app(UserManager::class);
        $userManager->create($request->toArray());
        $token = $userManager->auth($email, $password);

        return (new Response(['Authorization','Bearer '.$token], 200))->header('Access-Control-Allow-Origin', '*');
    }
}
