<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Repositories\FieldRepository;
use Illuminate\Http\Request;

class CareerController extends Controller
{
    public function index(Request $request, $field_id)
    {
        $fieldRepo = new FieldRepository();
        return view('backend.careers.index', ['field' => $fieldRepo->findField($field_id)]);
    }
    
    public function register(Request $request, $field_id)
    {
        $fieldRepo = new FieldRepository();
        return view('backend.careers.register', ['field' => $fieldRepo->findField($field_id)]);
    }
}
