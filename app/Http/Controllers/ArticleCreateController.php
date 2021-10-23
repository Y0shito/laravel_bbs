<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Enums\PublicStatus;
use App\Http\Requests\ArticleRequest;
use App\Traits\Spaceremoval;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Article;

class ArticleCreateController extends Controller
{
    use Spaceremoval;

    public function showArticleCreate()
    {
        return view('article.create');
    }

    public function toPreview(ArticleRequest $request)
    {
        $title = Spaceremoval::spaceRemoval($request->title);
        $body = Spaceremoval::spaceRemoval($request->body);

        session(compact('title', 'body'));

        return redirect()->route('preview');
    }
}
