<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RecommendationController extends Controller
{
    public function index()
    {
        return view('backend.recommendations.history');
    }

    public function all()
    {
        return view('backend.recommendations.all-history');
    }
}
