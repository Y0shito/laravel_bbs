<?php declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FollowController extends Controller
{
    public function follow(Request $request)
    {
        $user = User::find(Auth::id());
        $user->userFollows()->attach($request->following_id);
        $user->increment('followings');

        $opponent = User::find($request->following_id);
        $opponent->increment('followers');

        return back();
    }

    public function unFollow(Request $request)
    {
        $user = User::find(Auth::id());
        $user->userFollows()->detach($request->following_id);
        $user->decrement('followings');

        $opponent = User::find($request->following_id);
        $opponent->decrement('followers');

        return back();
    }
}
