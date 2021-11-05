<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Bookmark;
use Illuminate\Support\Facades\Auth;

class MypageBookmarksController extends Controller
{
    public function showBookmarks()
    {
        $bookmarks = Bookmark::where('user_id', Auth::id())->with('article')->get();
        return view('mypage.bookmarks', ['articles' => $bookmarks]);
    }
}
