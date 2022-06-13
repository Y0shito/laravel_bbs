<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Bookmark;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class BookmarkController extends Controller
{
    public function add(Request $request)
    {
        $id = $request->article_id;
        DB::beginTransaction();

        try {
            $bookmark = Bookmark::create(
                [
                    'user_id' => Auth::id(),
                    'article_id' => $id
                ]
            );

            $article = Article::find($id);
            $article->timestamps = false;
            $article->increment('bookmarks');
            $article->user()->increment('total_bookmarked');

            DB::commit();
        } catch (Exception $e) {
            DB::rollback();
            Log::critical($e);
        }

        return back()->with(['class' => 'text-blue-500 body-font bg-blue-100 shadow-md', 'message' => "「{$article->title}」をブックマークしました"]);
    }

    public function remove(Request $request)
    {
        $id = $request->article_id;
        DB::beginTransaction();

        try {
            $bookmark = Bookmark::where(
                [
                    'user_id' => Auth::id(),
                    'article_id' => $id
                ]
            )->delete();

            $article = Article::find($id);
            $article->timestamps = false;
            $article->decrement('bookmarks');
            $article->user()->decrement('total_bookmarked');

            DB::commit();
        } catch (Exception $e) {
            DB::rollback();
            Log::critical();
        }

        return back()->with(['class' => 'text-red-500 body-font bg-red-100 shadow-md', 'message' => "「{$article->title}」をブックマークから外しました"]);
    }
}
