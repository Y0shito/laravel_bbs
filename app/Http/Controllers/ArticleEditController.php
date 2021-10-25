<?php declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ArticleEditController extends Controller
{
    public function showArticleEdit(){
        return view('article.edit');
    }
}
