<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\ArticleRequest;
use App\Models\Article;
use App\Traits\Spaceremoval;
use Illuminate\Http\Request;

class ArticleEditController extends Controller
{
    use Spaceremoval;

    public function showArticleEdit(Request $request)
    {
        $article = Article::find($request->id);
        return view('article.edit', compact('article'));
    }

    public function previewFromEdit(ArticleRequest $request)
    {
        $title = Spaceremoval::spaceRemoval($request->title);
        $body = Spaceremoval::spaceRemoval($request->body);
        $id = $request->id;

        session(compact('title', 'body', 'id'));

        return view('article.edit-preview');
    }
}
