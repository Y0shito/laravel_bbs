<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ArticlePreviewController extends Controller
{
    public function showArticlePreview()
    {
        return view('article.preview');
    }
}
