<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CombinationController extends Controller
{
    public function index()
    {
        return view('backend.combinations.index');
    }

    public function register()
    {
        return view('backend.combinations.register');
    }
}
