<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function showSearch()
    {
        return view('search');
    }
}
