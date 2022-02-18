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
        $article_id = session('id');
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
            return redirect()->route('articles', ['id' => $article_id]);
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
            return redirect()->route('userpage', ['id' => Auth::id()]);
        } catch (Exception $e) {
            DB::rollback();
            $error = $e->getMessage();
            dd($error);
            return back();
        }
    }
}
