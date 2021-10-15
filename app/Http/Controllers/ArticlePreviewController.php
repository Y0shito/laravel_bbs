<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ArticlePreviewController extends Controller
{
    public function showArticlePreview()
    {
        return view('article.preview');
    }

    public function completion(Request $request)
    {
        DB::beginTransaction(); //トランザクションの開始
        try {
            $article = Article::updateOrCreate(
                ['id' => session('article_id')],
                [
                    'title' => session('title'),
                    'body' => session('body'),
                    'author_id' => Auth::id(),
                    // 'open' => PublicStatus::OPEN,
                    'category' => $request->category,
                ]
            );

            DB::commit(); //データの挿入
            $request->session()->forget(['title', 'body', 'article_id']);
            return redirect('/mypage');
        } catch (\Exception $e) { //例外発生時
            // 本来はここに例外時の処理を書く
            DB::rollback(); //適用前に戻す
            $error = $e->getMessage();
            dd($error);
        }
    }
}
