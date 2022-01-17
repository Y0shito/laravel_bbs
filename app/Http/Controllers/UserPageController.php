<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;

class UserPageController extends Controller
{
    public function showUserpage($id)
    {
        $user = User::where('id', $id)->withCount(['userFollowers' => function (Builder $query) {
            $query->where('user_id', Auth::id());
        }])->first();
        $articles = Article::openArticles()->where('user_id', $id)->with(['user', 'category'])
            ->withCount(['bookmark' => function (Builder $query) {
                $query->where('user_id', Auth::id());
            }])->get();

        return view('userpage', compact('user', 'articles'));
    }
}
