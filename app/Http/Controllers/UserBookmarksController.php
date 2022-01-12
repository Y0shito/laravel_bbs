<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Bookmark;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;

class UserBookmarksController extends Controller
{
    public function showUserBookmarks($id)
    {
        $user =  User::find($id);
        $bookmarks = Bookmark::where('user_id', $id)->with(['article'])->get();
        return view('userbookmarks', compact('user'), ['articles' => $bookmarks]);
    }
}
