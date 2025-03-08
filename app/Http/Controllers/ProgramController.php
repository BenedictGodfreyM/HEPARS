<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\RecommendationService;
use Illuminate\Contracts\View\View;

class ProgramController extends Controller
{
    public function showRecommendations(Request $request): View
    {
        $recommendations = (new RecommendationService)->getRecommendations($request["career_path_id"], $request["student_results"]);
        return view('recommendations', compact('recommendations'));
    }
}
