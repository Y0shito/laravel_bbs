<?php declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ArticleRequest;
use App\Traits\Spaceremoval;

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
