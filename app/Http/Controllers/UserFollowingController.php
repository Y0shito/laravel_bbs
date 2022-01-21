<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;

class UserFollowingController extends Controller
{
    public function showFollowingPage(Request $request)
    {
        $user_id = User::where('id', $request->id);
        $user = $user_id->withCount(['userFollowers' => function (Builder $query) {
            $query->where('user_id', Auth::id());
        }])->first();
        $followings = $user_id->with('userFollows')->get();
        // dd($followings);
        return view('userfollowing', compact('user','followings'));
    }
}
