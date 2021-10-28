<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Article;

class IndexController extends Controller
{
    public function showIndex()
    {
        $articles = Article::with('user')->paginate(10);
        return view('index', compact('articles'));
    }
}
