<?php

namespace App\Http\Controllers;

use App\Enums\PublicStatus;
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
        DB::beginTransaction();
        try {
            $article = Article::Create(
                [
                    'user_id' => Auth::id(),
                    'title' => session('title'),
                    'body' => session('body'),
                    'public_status' => PublicStatus::OPEN,
                ]
            );
            DB::commit();
            $request->session()->forget(['title', 'body']);
            return redirect()->route('index');
        } catch (\Exception $e) {
            DB::rollback();
            $error = $e->getMessage();
            dd($error);
            return back();
        }
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
                ]
            );
            DB::commit();
            $request->session()->forget(['title', 'body']);
            return redirect()->route('mypage');
        } catch (\Exception $e) {
            DB::rollback();
            $error = $e->getMessage();
            dd($error);
            return back();
        }
    }
}
