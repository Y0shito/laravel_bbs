<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Article;

class IndexController extends Controller
{
    public function showIndex()
    {
        $articles = Article::getArticles()->sortable()->paginate(15);
        return view('index', compact('articles'));
    }
}
