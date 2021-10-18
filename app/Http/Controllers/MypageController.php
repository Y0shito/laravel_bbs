<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MypageController extends Controller
{
    public function showMypage()
    {
        return view('mypage.mypage');
    }
}
