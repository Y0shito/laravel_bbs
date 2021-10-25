<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Article;
use App\Traits\Spaceremoval;
use App\Http\Requests\ArticleRequest;
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

        session(compact('title', 'body'));

        return redirect()->route('preview');
    }
}
