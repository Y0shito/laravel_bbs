<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\DeletedUser;
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
        $userTwitterId = $user->getId();
        $userName = $user->getName();

        //削除済みユーザーがログインしたら
        if (DeletedUser::where('twitter_id', $userTwitterId)->exists()) {
            abort(403);
        };

        DB::beginTransaction();
        try {
            Auth::login(
                User::firstOrCreate([
                    'twitter_id' => $userTwitterId
                ], [
                    'name' => $userName
                ]),
                true
            );

            $loginUser = User::where('twitter_id', $userTwitterId)->first();

            if ($loginUser->name !== $userName) {
                $loginUser->update(['name' => $userName]);
            }

            DB::commit();
        } catch (Exception $e) {
            DB::rollback();
            return back();
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
        $deletedUser = User::find($request->id);
        DB::beginTransaction();

        try {
            $insert = DeletedUser::create(
                [
                    'user_id' => $deletedUser->id,
                    'name' => $deletedUser->name,
                    'twitter_id' => $deletedUser->twitter_id,
                ]
            );

            User::destroy($deletedUser->id);
            DB::commit();
            return redirect()->route('index');
        } catch (Exception $e) {
            DB::rollback();
            return back();
        }
    }
}
