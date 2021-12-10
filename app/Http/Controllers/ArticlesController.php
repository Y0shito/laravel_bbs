<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Bookmark;
use Illuminate\Support\Facades\Auth;

class ArticlesController extends Controller
{
    public function showArticles($id)
    {
        $userId = Auth::id();

        $article = Article::find($id);
        $article->timestamps = false;
        $article->increment('views');
        //incrementだとupdate走る→+1の方がいい？

        if (Auth::check() and !($article->user_id === $userId)) {
            if ($article->bookmark()->where('user_id', $userId)->exists()) {
                $button = 'bookmarked';
            } else {
                $button = 'notBookmark';
            }
        } else {
            $button = 'disable';
        }
        return view('articles', compact('article', 'button'));
    }
}
