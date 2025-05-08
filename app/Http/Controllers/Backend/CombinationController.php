<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Repositories\CombinationRepository;
use App\Repositories\ProgramRepository;
use Illuminate\Http\Request;

class CombinationController extends Controller
{
    public function index()
    {
        return view('backend.combinations.index');
    }

    public function register()
    {
        return view('backend.combinations.register');
    }
    
    public function edit(Request $request, $combination_id)
    {
        $combinationRepo = new CombinationRepository();
        return view('backend.combinations.edit', [
            'combination' => $combinationRepo->findCombination($combination_id)
        ]);
    }
}
