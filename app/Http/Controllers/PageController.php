<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    // ROTTE STATICHE
    //1. HOME
    function home()
    {
        return view('home');
    }
}
