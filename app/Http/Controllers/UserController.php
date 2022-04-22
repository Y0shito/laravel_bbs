<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
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
        $userId = $user->getId();
        $userName = $user->getName();

        DB::beginTransaction();
        try {
            Auth::login(
                User::firstOrCreate([
                    'twitter_id' => $userId
                ], [
                    'name' => $userName
                ]),
                true
            );

            $loginUser = User::where('twitter_id', $userId)->first();

            if ($loginUser->name !== $userName) {
                $loginUser->update(['name' => $userName]);
            }

            DB::commit();
        } catch (Exception $e) {
            DB::rollback();
            $error = $e->getMessage();
            dd($error);
        }
        return redirect()->route('index');
    }

    //firstOrCreate内に欲しいカラムいれればもっと登録出来る？（twitterのアバターなど）

    public function logout()
    {
        Auth::logout();
        return redirect()->route('index');
    }

    public function userDelete(Request $request)
    {
        DB::beginTransaction();

        try {
            User::destroy($request->id);
            DB::commit();
            return redirect()->route('index');
        } catch (Exception $e) {
            DB::rollback();
            $error = $e->getMessage();
            dd($error);
        }
    }
}
