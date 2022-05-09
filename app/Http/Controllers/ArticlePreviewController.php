<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Enums\PublicStatus;
use App\Models\Article;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ArticlePreviewController extends Controller
{
    public function showPreviewPage()
    {
        if (session()->missing(['title', 'body'])) {
            return redirect()->route('index');
        }

        return view('article.preview');
    }

    public function completion(Request $request)
    {
        DB::beginTransaction();
        try {
            $article = Article::Create(
                [
                    'user_id' => Auth::id(),
                    'title' => session('title'),
                    'body' => session('body'),
                    'public_status' => PublicStatus::OPEN,
                    'category_id' => (int)$request->category,
                ]
            );
            DB::commit();
            $request->session()->forget(['title', 'body']);
        } catch (Exception $e) {
            DB::rollback();
            return back()
                ->with(['class' => 'text-red-500 body-font bg-red-100 shadow-md', 'message' => '不正なページ移動です']);
        }

        return redirect()
            ->route('articles', ['id' => $article->id])
            ->with(['class' => 'text-blue-500 body-font bg-blue-100 shadow-md', 'message' => "「{$article->title}」を公開しました"]);
    }

    public function draft(Request $request)
    {
        DB::beginTransaction();
        try {
            $article = Article::Create(
                [
                    'user_id' => Auth::id(),
                    'title' => session('title'),
                    'body' => session('body'),
                    'public_status' => PublicStatus::CLOSE,
                    'category_id' => (int) $request->category,
                ]
            );
            DB::commit();
            $request->session()->forget(['title', 'body']);
        } catch (Exception $e) {
            DB::rollback();
            return back()
                ->with(['class' => 'text-red-500 body-font bg-red-100 shadow-md', 'message' => '不正なページ移動です']);
        }

        return redirect()
            ->route('userpage', ['id' => Auth::id()])
            ->with(['class' => 'text-green-500 body-font bg-green-100 shadow-md', 'message' => "「{$article->title}」を下書きに保存しました"]);
    }
}
