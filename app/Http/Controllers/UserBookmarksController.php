<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Bookmark;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;

class UserBookmarksController extends Controller
{
    public function showUserBookmarks($id)
    {
        $user = User::where('id', $id)->withCount(['userFollowers' => function (Builder $query) {
            $query->where('user_id', Auth::id());
        }])->first();
        $bookmarks = Bookmark::where('user_id', $id)->with(['article'])->get();
        $isMyPage = (int)$id === Auth::id();
        return view('userbookmarks', compact('user', 'isMyPage'), ['articles' => $bookmarks]);
    }
}
