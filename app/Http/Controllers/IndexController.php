<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Support\Facades\Auth;

class IndexController extends Controller
{
    public function showIndex()
    {
        $articles = Article::openArticles()->with('user')->sortable()->paginate(5);
        return view('index', compact('articles'));
    }
}
