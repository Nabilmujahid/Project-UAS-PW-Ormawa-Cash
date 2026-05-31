<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LandingPageController extends Controller
{
    public function index()
    {
        return view('public.index');
    }

    public function tentang()
    {
        return view('public.tentang');
    }
}