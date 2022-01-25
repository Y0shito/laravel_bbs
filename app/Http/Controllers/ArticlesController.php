<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;

class ArticlesController extends Controller
{
    public function showArticles($id)
    {
        $article = Article::openArticles()->withCount(['bookmark' => function (Builder $query) {
            $query->where('user_id', Auth::id());
        }])->find($id);
        $article->timestamps = false;
        $article->increment('views');

        return view('articles', compact('article'));
    }
}
