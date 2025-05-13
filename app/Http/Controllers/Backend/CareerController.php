<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Repositories\CareerRepository;
use App\Repositories\DisciplineRepository;
use Illuminate\Http\Request;

class CareerController extends Controller
{
    public function index(Request $request, $discipline_id)
    {
        $disciplineRepo = new DisciplineRepository();
        return view('backend.careers.index', ['discipline' => $disciplineRepo->findDiscipline($discipline_id)]);
    }
    
    public function register(Request $request, $discipline_id)
    {
        $disciplineRepo = new DisciplineRepository();
        return view('backend.careers.register', ['discipline' => $disciplineRepo->findDiscipline($discipline_id)]);
    }
    
    public function edit(Request $request, $discipline_id, $career_id)
    {
        $disciplineRepo = new DisciplineRepository();
        $careerRepo = new CareerRepository();
        return view('backend.careers.edit', [
            'discipline' => $disciplineRepo->findDiscipline($discipline_id),
            'career' => $careerRepo->findCareer($career_id)
        ]);
    }
}
