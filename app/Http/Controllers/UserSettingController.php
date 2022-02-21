<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;

class UserSettingController extends Controller
{
    public function showSettings($id)
    {
        $isMyPage = (int)$id === Auth::id();

        if ($isMyPage) {
            $user = User::where('id', $id)->withCount(['userFollowers' => function (Builder $query) {
                $query->where('user_id', Auth::id());
            }])->first();

            return view('settings', compact('user', 'isMyPage'));
        }
        return back();
    }
}
