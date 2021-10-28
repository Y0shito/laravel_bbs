<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Enums\PublicStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Article;
use Illuminate\Support\Facades\Auth;
use Exception;

class ArticleEditPreviewController extends Controller
{
    public function showEditPreview()
    {
        return view('article.edit-preview');
    }

    public function articleUpdate(Request $request)
    {
        $rule = ['id' => session('id'), 'user_id' => Auth::id()];
        DB::beginTransaction();
        try {
            $article = Article::where($rule)->update(
                [
                    'title' => session('title'),
                    'body' => session('body'),
                    'public_status' => PublicStatus::OPEN,
                ]
            );
            DB::commit();
            $request->session()->forget(['title', 'body', 'id']);
            return redirect()->route('mypage');
        } catch (Exception $e) {
            DB::rollback();
            $error = $e->getMessage();
            dd($error);
            return back();
        }
    }

    public function editedArticleDraft(Request $request)
    {
        $rule = ['id' => session('id'), 'user_id' => Auth::id()];
        DB::beginTransaction();
        try {
            $article = Article::where($rule)->update(
                [
                    'title' => session('title'),
                    'body' => session('body'),
                    'public_status' => PublicStatus::CLOSE,
                ]
            );
            DB::commit();
            $request->session()->forget(['title', 'body', 'id']);
            return redirect()->route('mypage');
        } catch (Exception $e) {
            DB::rollback();
            $error = $e->getMessage();
            dd($error);
            return back();
        }
    }
}
