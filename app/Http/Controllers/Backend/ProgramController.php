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
    
    public function register(Request $request, $institution_id)
    {
        $institutionRepo = new InstitutionRepository();
        return view('backend.programs.register', ['institution' => $institutionRepo->findInstitution($institution_id)]);
    }
    
    public function show(Request $request, $institution_id, $program_id)
    {
        $institutionRepo = new InstitutionRepository();
        $programRepo = new ProgramRepository();
        return view('backend.programs.show', [
            'institution' => $institutionRepo->findInstitution($institution_id),
            'program' => $programRepo->findProgram($program_id)
        ]);
    }
    
    public function edit(Request $request, $institution_id, $program_id)
    {
        $institutionRepo = new InstitutionRepository();
        $programRepo = new ProgramRepository();
        return view('backend.programs.edit', [
            'institution' => $institutionRepo->findInstitution($institution_id),
            'program' => $programRepo->findProgram($program_id)
        ]);
    }
}
