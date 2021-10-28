<?php declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

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
        $user = Socialite::driver('twitter')->user();

        Auth::login(
            User::firstOrCreate([
                'name' => $user->getName(),
            ]),
            true
        );
        return redirect()->route('index');
    }
    //トランザクション張っておく
    //auth::login内に欲しいカラムいれればもっと登録出来る？（twitterのアバターなど）
    //ただこのメソッドだと、twitter側でアバター変わっている場合、再ログイン時更新されず古いアバターのままになる

    public function logout()
    {
        Auth::logout();
        return redirect()->route('index');
    }
}
