<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ArticlesController extends Controller
{
    public function showArticles()
    {
        return view('articles');
    }
}
