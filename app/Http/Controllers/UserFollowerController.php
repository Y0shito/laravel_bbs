<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserFollowerController extends Controller
{
    public function showFollowersPage(Request $request)
    {
        $user = User::with('userFollowers')
            ->withCount(['userFollowers' => function (Builder $query) {
                $query->where('user_id', Auth::id());
            }])->find($request->id);

        return view('userfollower', compact('user'));
    }
}
