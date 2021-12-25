<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Enums\PublicStatus;
use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MypageController extends Controller
{
    public function showMypage()
    {
        $articles = Article::where('user_id', Auth::id())->with('category')->get();
        return view('mypage.mypage', compact('articles'));
    }

    public function StatusOpen(Request $request)
    {
        Article::find($request->id)->update(['public_status' => PublicStatus::OPEN]);
        return redirect()->route('mypage');
    }

    public function statusClose(Request $request)
    {
        Article::find($request->id)->update(['public_status' => PublicStatus::CLOSE]);
        return redirect()->route('mypage');
    }

    public function articleDelete(Request $request)
    {
        Article::find($request->id)->delete();
        return redirect()->route('mypage');
    }
}
