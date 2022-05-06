<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Enums\PublicStatus;
use App\Models\Article;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserPageController extends Controller
{
    public function showUserpage($id)
    {
        $user = User::getUserInfo($id);

        $isMyPage = $user->id === Auth::id();

        if ($isMyPage) {
            $articles = Article::where('user_id', $id)->with(['user', 'category'])
                ->withCount(['bookmark' => function (Builder $query) {
                    $query->where('user_id', Auth::id());
                }])->get();
        } else {
            $articles = Article::getArticles()->where('user_id', $id)->get();
        }

        return view('userpage', compact('user', 'articles', 'isMyPage'));
    }

    public function StatusOpen(Request $request)
    {
        $article = Article::find($request->id);
        $article->timestamps = false;
        $article->update(['public_status' => PublicStatus::OPEN]);
        return back()
            ->with(['class' => 'text-blue-500 body-font bg-blue-100 shadow-md', 'message' => "「{$article->title}」を公開しました"]);
    }

    public function statusClose(Request $request)
    {
        $article = Article::find($request->id);
        $article->timestamps = false;
        $article->update(['public_status' => PublicStatus::CLOSE]);
        return back()
            ->with(['class' => 'text-gray-500 body-font bg-gray-100 shadow-md', 'message' => "「{$article->title}」を非公開にしました"]);
    }

    public function articleDelete(Request $request)
    {
        $article = Article::find($request->id);
        $article->delete();
        return back()
            ->with(['class' => 'text-red-500 body-font bg-red-100 shadow-md', 'message' => "「{$article->title}」を削除しました"]);
    }
}
