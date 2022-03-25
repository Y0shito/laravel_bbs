<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Bookmark;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;

class UserBookmarksController extends Controller
{
    public function showUserBookmarks($id)
    {
        $user = User::getUserInfo($id);

        $bookmarkedArticles = Article::whereIn('id', Bookmark::where('user_id', $id)->pluck('article_id'))
            ->withCount(['bookmark' => function (Builder $query) {
                $query->where('user_id', Auth::id());
            }])->get();
        $isMyPage = (int)$id === Auth::id();
        return view('userbookmarks', compact('user', 'isMyPage'), ['articles' => $bookmarkedArticles]);
    }
}
