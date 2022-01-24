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
        $user = User::with('userFollows')
            ->withCount(['userFollowers' => function (Builder $query) {
                $query->where('user_id', Auth::id());
            }])->find($request->id);
        return view('userfollowing', compact('user'));
    }
}
