<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AccessControlController extends Controller
{
    public function roles()
    {
        return view('backend.access_control.roles');
    }
    
    public function permissions()
    {
        return view('backend.access_control.permissions');
    }
    
    public function users()
    {
        return view('backend.access_control.users');
    }
}
