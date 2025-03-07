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
    
    public function edit(Request $request, $subject_id)
    {
        return view('backend.subjects.edit', ['subject_id' => $subject_id ]);
    }
}
