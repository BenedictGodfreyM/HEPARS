<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class InstitutionController extends Controller
{
    public function index()
    {
        return view('backend.institutions.index');
    }

    public function register()
    {
        return view('backend.institutions.register');
    }

    public function edit(Request $request, $institutions_id)
    {
        return view('backend.institutions.edit', ['institution_id' => $institutions_id]);
    }
}
