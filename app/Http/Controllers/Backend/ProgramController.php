<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Repositories\InstitutionRepository;
use App\Repositories\ProgramRepository;
use Illuminate\Http\Request;

class ProgramController extends Controller
{
    public function index(Request $request, $institution_id)
    {
        $institutionRepo = new InstitutionRepository();
        return view('backend.programs.index', ['institution' => $institutionRepo->findInstitution($institution_id)]);
    }
}
