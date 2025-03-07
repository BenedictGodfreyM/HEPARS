<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CareerPathController extends Controller
{
    public function index()
    {
        return view('backend.career_paths.index');
    }
    
    public function register()
    {
        return view('backend.career_paths.register');
    }
    
    public function edit(Request $request, $career_path_id)
    {
        return view('backend.career_paths.edit', ['career_path_id' => $career_path_id ]);
    }
}
