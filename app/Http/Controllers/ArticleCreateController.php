<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ArticleCreateController extends Controller
{
    public function showArticleCreate()
    {
        return view('article.create');
    }
}
