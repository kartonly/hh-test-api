<?php


namespace App\Http\Controllers;


use App\Http\Controllers\Controller;
use App\Http\Managers\UserManager;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LogoutController extends Controller
{
    public function __invoke(Request $request)
    {
        $userManager = app(UserManager::class, ['user' => Auth::user()]);
        $userManager->logout();

        return (new Response('Logged out', 200));
    }
}
