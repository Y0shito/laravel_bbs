<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use App\Enums\PublicStatus;
use Illuminate\Http\Request;

class UserPageController extends Controller
{
    public function showUserpage($id)
    {
        $user = User::where('id', $id)->withCount(['userFollowers' => function (Builder $query) {
            $query->where('user_id', Auth::id());
        }])->first();

        $query = Article::where('user_id', $id)->with(['user', 'category'])
            ->withCount(['bookmark' => function (Builder $query) {
                $query->where('user_id', Auth::id());
            }]);

        if ((int)$id === Auth::id()) {
            $articles = $query->get();
        } else {
            $articles = $query->openArticles()->get();
        }

        return view('userpage', compact('user', 'articles'));
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
