<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DisciplineController extends Controller
{
    public function index()
    {
        return view('backend.disciplines.index');
    }
    
    public function register()
    {
        return view('backend.disciplines.register');
    }
    
    public function edit(Request $request, $discipline_id)
    {
        return view('backend.disciplines.edit', ['discipline_id' => $discipline_id ]);
    }
}