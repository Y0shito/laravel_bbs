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

        $query = Article::where('user_id', $id)->with(['user', 'category'])
            ->withCount(['bookmark' => function (Builder $query) {
                $query->where('user_id', Auth::id());
            }]);

        if ($isMyPage) {
            $articles = $query->get();
        } else {
            $articles = $query->openArticles()->get();
        }

        return view('userpage', compact('user', 'articles', 'isMyPage'));
    }

    public function StatusOpen(Request $request)
    {
        Article::find($request->id)->update(['public_status' => PublicStatus::OPEN]);
        return back();
    }

    public function statusClose(Request $request)
    {
        Article::find($request->id)->update(['public_status' => PublicStatus::CLOSE]);
        return back();
    }

    public function articleDelete(Request $request)
    {
        Article::find($request->id)->delete();
        return back();
    }
}
