<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SearchController extends Controller
{
    public function showSearch(Request $request)
    {
        if (!empty($request->search)) {
            $query = Article::openArticles();
            $words = preg_split('/[\p{Z}\p{Cc}]++/u', $request->search, 5, PREG_SPLIT_NO_EMPTY);
            foreach ($words as $word) {
                if (preg_match('/-/', $word) === 0) {
                    $query->where('title', 'like', "%$word%");
                } elseif (preg_match('/-/', $word) === 1) {
                    $query->where('title', 'not like', '%' . preg_replace('/-/', '', $word) . '%');
                }
            }
            $articles = $query->with(['user', 'category'])->withCount(['bookmark' => function (Builder $query) {
                $query->where('user_id', Auth::id());
            }])->sortable()->paginate(5);
            return view('search', ['words' => $request->search, 'articles' => $articles]);
        }
        return view('search');
    }
}
