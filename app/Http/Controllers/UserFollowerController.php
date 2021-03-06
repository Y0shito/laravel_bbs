<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UserFollowerController extends Controller
{
    public function showFollowersPage($id)
    {
        $user = User::getUserInfo($id);

        $isMyPage = (int)$id === Auth::id();

        $followers = DB::table('follow_user as opponent')
            ->leftJoin('follow_user as myself', function ($join) {
                $join->on('opponent.user_id', '=', 'myself.following_id')
                    ->on('opponent.user_id', '<>', 'myself.user_id')
                    ->where('myself.user_id', '=', Auth::id());
            })
            ->leftJoin('users', 'opponent.user_id', '=', 'users.id')
            ->where('opponent.following_id', '=', $id)
            ->select('opponent.id', 'opponent.user_id', 'users.name', 'users.total_bookmarked', 'users.followings', 'users.followers', 'myself.user_id as is_following')
            ->orderBy('opponent.id', 'asc')
            ->get();

        return view('userfollower', compact('user', 'isMyPage'), ['userlist' => $followers]);
    }
}
