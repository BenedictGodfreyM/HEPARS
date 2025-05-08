<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function index()
    {
        return view('frontend.home');
    }

    public function admission_portals()
    {
        return view('frontend.admission_portals');
    }
}
