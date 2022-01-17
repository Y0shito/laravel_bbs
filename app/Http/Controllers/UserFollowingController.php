<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;

class UserFollowingController extends Controller
{
    public function showFollowingPage($id)
    {
        $user = User::where('id', $id)->withCount(['userFollowers' => function (Builder $query) {
            $query->where('user_id', Auth::id());
        }])->first();

        return view('userfollowing', compact('user'));
    }
}
