<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Enums\PublicStatus;
use App\Models\Article;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class MypageController extends Controller
{
    public function showMypage()
    {
        $articles = Article::withoutGlobalScope('public_status')->where('user_id', Auth::id())->get();
        return view('mypage.mypage', compact('articles'));
    }

    public function StatusOpen(Request $request)
    {
        Article::withoutGlobalScope('public_status')->find($request->id)->update(['public_status' => PublicStatus::OPEN]);
        return redirect()->route('mypage');
    }

    public function statusClose(Request $request)
    {
        Article::find($request->id)->update(['public_status' => PublicStatus::CLOSE]);
        return redirect()->route('mypage');
    }

    public function articleDelete(Request $request)
    {
        Article::withoutGlobalScope('public_status')->find($request->id)->delete();
        return redirect()->route('mypage');
    }
}
