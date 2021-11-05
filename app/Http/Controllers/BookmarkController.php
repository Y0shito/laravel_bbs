<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Bookmark;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookmarkController extends Controller
{
    public function add(Request $request)
    {
        $bookmark = Bookmark::create(
            [
                'user_id' => Auth::id(),
                'article_id' => $request->article_id
            ]
        );
        return back();
    }

    public function remove(Request $request)
    {
        $bookmark = Bookmark::where(
            [
                'user_id' => Auth::id(),
                'article_id' => $request->article_id
            ]
        )->delete();
        return back();
    }
}
