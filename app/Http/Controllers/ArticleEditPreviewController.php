<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Enums\PublicStatus;
use App\Models\Article;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ArticleEditPreviewController extends Controller
{
    public function articleUpdate(Request $request)
    {
        $rule = ['id' => session('id'), 'user_id' => Auth::id()];
        DB::beginTransaction();
        try {
            $article = Article::where($rule)->first();
            $article->update(
                [
                    'title' => session('title'),
                    'body' => session('body'),
                    'public_status' => PublicStatus::OPEN,
                ]
            );

            DB::commit();
            $request->session()->forget(['title', 'body', 'id']);
        } catch (Exception $e) {
            DB::rollback();
            $error = $e->getMessage();
            dd($error);
            return back();
        }

        return redirect()
            ->route('articles', ['id' => $article->id])
            ->with(['class' => 'text-blue-500 body-font bg-blue-100 shadow-md', 'message' => "「{$article->title}」を更新、公開しました"]);
    }

    public function editedArticleDraft(Request $request)
    {
        $rule = ['id' => session('id'), 'user_id' => Auth::id()];
        DB::beginTransaction();
        try {
            $article = Article::where($rule)->first();
            $article->update(
                [
                    'title' => session('title'),
                    'body' => session('body'),
                    'public_status' => PublicStatus::CLOSE,
                ]
            );
            DB::commit();
            $request->session()->forget(['title', 'body', 'id']);
        } catch (Exception $e) {
            DB::rollback();
            $error = $e->getMessage();
            dd($error);
            return back();
        }

        return redirect()
            ->route('userpage', ['id' => Auth::id()])
            ->with(['class' => 'text-green-500 body-font bg-green-100 shadow-md', 'message' => "「{$article->title}」を更新し、下書きに保存しました"]);
    }
}
