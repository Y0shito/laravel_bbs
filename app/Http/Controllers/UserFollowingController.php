<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserFollowingController extends Controller
{
    public function showFollowingPage(Request $request)
    {
        $user = User::with('userFollows')
            ->withCount(['userFollowers' => function (Builder $query) {
                $query->where('user_id', Auth::id());
            }])->find($request->id);
        $isMyPage = (int)$request->id === Auth::id();

        return view('userfollowing', compact('user', 'isMyPage'));
    }
}
