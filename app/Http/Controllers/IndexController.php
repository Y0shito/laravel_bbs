<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;

class IndexController extends Controller
{
    public function showIndex()
    {
        $articles = Article::openArticles()->with('user')->withCount(['bookmark' => function (Builder $query) {
            $query->where('user_id', Auth::id());
        }])->sortable()->paginate(5);
        return view('index', compact('articles'));
    }
}
