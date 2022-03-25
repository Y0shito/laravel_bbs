<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Article;
use Exception;

class ArticlesController extends Controller
{
    public function showArticles($id)
    {
        try {
            $article = Article::getArticles()->find($id);
            $article->timestamps = false;
            $article->increment('views');

            return view('articles', compact('article'));
        } catch (Exception $e) {
            return back();
        }
    }
}
