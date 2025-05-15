<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FieldController extends Controller
{
    public function index()
    {
        return view('backend.fields.index');
    }
    
    public function register()
    {
        return view('backend.fields.register');
    }
    
    public function edit(Request $request, $field_id)
    {
        return view('backend.fields.edit', ['field_id' => $field_id ]);
    }
}