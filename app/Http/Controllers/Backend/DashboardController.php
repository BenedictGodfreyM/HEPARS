<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Repositories\CareerRepository;
use App\Repositories\InstitutionRepository;
use App\Repositories\ProgramRepository;
use App\Repositories\UserRepository;

class DashboardController extends Controller
{    
    protected $institutionRepo;
    protected $programRepo;
    protected $careerRepo;
    protected $userRepo;

    public function __construct()
    {
        $this->institutionRepo = new InstitutionRepository();
        $this->programRepo = new ProgramRepository();
        $this->careerRepo = new CareerRepository();
        $this->userRepo = new UserRepository();
    }

    public function index()
    {        return view('backend.dashboard')->with('total_institutions', $this->institutionRepo->totalInstitutions())
                                        ->with('total_programs', $this->programRepo->totalPrograms())
                                        ->with('total_careers', $this->careerRepo->totalCareers())
                                        ->with('total_users', $this->userRepo->totalUsers());
    }
}
