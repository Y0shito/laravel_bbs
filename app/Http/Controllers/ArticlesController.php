<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Article;

class ArticlesController extends Controller
{
    public function showArticles($id)
    {
        $article = Article::find($id);
        $article->timestamps = false;
        $article->increment('views');
        return view('articles', compact('article'));
    }
}
