<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UserFollowingController extends Controller
{
    public function showFollowingPage(Request $request)
    {
        $user = User::where('id', $request->id)->withCount(['userFollowers' => function (Builder $query) {
            $query->where('user_id', Auth::id());
        }])->first();
        // dd($user);
        return view('userfollowing', compact('user'));
    }
}
