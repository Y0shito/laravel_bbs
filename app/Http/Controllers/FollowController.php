<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class FollowController extends Controller
{
    public function follow(Request $request)
    {
        User::find(Auth::id())->userFollows()->attach($request->following_id);
        return back();
    }

    public function unFollow(Request $request)
    {
        User::find(Auth::id())->userFollows()->detach($request->following_id);
        return back();
    }
}
