<?php declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Bookmark;
use App\Models\User;

class UserBookmarksController extends Controller
{
    public function showUserBookmarks($id)
    {
        $user =  User::find($id);
        $bookmarks = Bookmark::where('user_id', $id)->with(['article'])->get();
        return view('userbookmarks', compact('user'), ['articles' => $bookmarks]);
    }
}
