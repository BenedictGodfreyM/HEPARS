<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Repositories\CareerRepository;
use App\Repositories\InstitutionRepository;
use App\Repositories\ProgramRepository;
use App\Repositories\UserRepository;
use App\Services\RecommendationService;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{    
    protected $institutionRepo;
    protected $programRepo;
    protected $careerRepo;
    protected $userRepo;
    protected $recommendationService;

    public function __construct()
    {
        $this->institutionRepo = new InstitutionRepository();
        $this->programRepo = new ProgramRepository();
        $this->careerRepo = new CareerRepository();
        $this->userRepo = new UserRepository();
        $this->recommendationService = new RecommendationService();
    }

    public function index()
    {     
        $all_requests = $this->recommendationService->getChartData();
        $my_requests = $this->recommendationService->getChartData(Auth::user()->id);   
        return view('backend.dashboard')->with('total_institutions', $this->institutionRepo->totalInstitutions())
                                        ->with('total_programs', $this->programRepo->totalPrograms())
                                        ->with('total_careers', $this->careerRepo->totalCareers())
                                        ->with('total_users', $this->userRepo->totalUsers())
                                        ->with('my_recommendation_requests_data', $my_requests['data'])
                                        ->with('my_recommendation_requests_labels', $my_requests['labels'])
                                        ->with('all_recommendation_requests_data', $all_requests['data'])
                                        ->with('all_recommendation_requests_labels', $all_requests['labels']);
    }
}
