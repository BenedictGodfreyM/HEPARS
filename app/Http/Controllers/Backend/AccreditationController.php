<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AccreditationController extends Controller
{
    public function index()
    {
        return view('backend.accreditation.index');
    }
}
