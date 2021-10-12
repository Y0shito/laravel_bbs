<?php

namespace App\Http\Controllers;

use Laravel\Socialite\Facades\Socialite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

//ユーザー管理、ログイン、ログアウト、退会処理

class UserController extends Controller
{
    //Twitter認証
    public function login()
    {
        return Socialite::driver('twitter')->redirect();
    }

    public function callback()
    {
        $user = Socialite::driver('Twitter')->user();

        Auth::login(
            User::firstOrCreate([
                'name' => $user->getName(),
            ]),
            true
        );
        return redirect()->name('index');
    }
}
