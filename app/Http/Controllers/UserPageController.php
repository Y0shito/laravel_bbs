<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Article;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;

class UserPageController extends Controller
{
    public function showUserpage($id)
    {
        $user =  User::find($id);
        $articles = Article::openArticles()->where('user_id', $id)->with(['user', 'category'])->withCount(['bookmark' => function (Builder $query) {
            $query->where('user_id', Auth::id());
        }])->get();
        return view('userpage', compact('user', 'articles'));
    }
}
