<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SubjectController extends Controller
{
    public function index()
    {
        return view('backend.subjects.index');
    }
    
    public function register()
    {
        return view('backend.subjects.register');
    }
}
