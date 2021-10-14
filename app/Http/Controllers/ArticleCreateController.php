<?php declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Traits\Spaceremoval;

class ArticleCreateController extends Controller
{
    use Spaceremoval;

    public function showArticleCreate()
    {
        return view('article.create');
    }

    public function toPreview(Request $request)
    {
        $title = Spaceremoval::spaceRemoval($request->title);
        $body = Spaceremoval::spaceRemoval($request->body);

        session(compact('title', 'body'));

        dd(session('title'), session('body'));

        return redirect()->route('preview');
    }
}
