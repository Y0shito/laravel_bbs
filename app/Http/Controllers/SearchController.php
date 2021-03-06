<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function showSearch(Request $request)
    {
        $query = Article::getArticles();
        $search = $request->search;
        $category = (int) ($request->category);

        if (empty($search) && empty($category)) {
            return view('search');
        }

        if (! empty($category)) {
            $query->where('category_id', 'like', "$category");
        }

        if (! empty($search)) {
            $words = preg_split('/[\p{Z}\p{Cc}]++/u', $search, 5, PREG_SPLIT_NO_EMPTY);

            foreach ($words as $word) {
                if (preg_match('/-/', $word) === 0) {
                    $query->where('title', 'like', "%$word%");
                } elseif (preg_match('/-/', $word) === 1) {
                    $query->where('title', 'not like', '%' . preg_replace('/-/', '', $word) . '%');
                }
            }
        }

        $articles = $query->sortable()->paginate(15);

        return view('search', ['words' => $search, 'articles' => $articles, 'category' => $category]);
    }
}
