<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UserFollowingController extends Controller
{
    public function showFollowingPage(Request $request)
    {
        $user = User::with('userFollows')
            ->withCount(['userFollowers' => function (Builder $query) {
                $query->where('user_id', Auth::id());
            }])->find($request->id);

        $isMyPage = (int)$request->id === Auth::id();

        $followings = DB::table('follow_user as opponent')
            ->leftJoin('follow_user as myself', function ($join) {
                $join->on('opponent.following_id', '=', 'myself.following_id')
                    ->on('opponent.user_id', '<>', 'myself.user_id')
                    ->where('myself.user_id', '=', Auth::id());
            })
            ->leftJoin('users', 'opponent.following_id', '=', 'users.id')
            ->where('opponent.user_id', '=', $request->id)
            ->select('opponent.id', 'opponent.following_id as user_id', 'users.name', 'users.total_bookmarked', 'users.followings', 'users.followers', 'myself.user_id as is_following')
            ->orderBy('opponent.id', 'asc')
            ->get();

        return view('userfollowing', compact('user', 'isMyPage'), ['userlist' => $followings]);
    }
}
