<?php

namespace App\Services;

use App\Models\Program;
use Illuminate\Support\Facades\DB;

class RecommendationService
{
    public function __construct() {}

    /**
     * Request a list of programs and institutions they are offered based on the career choice and high school results
     *
     * @param string $careerPathId
     * @param array $studentResults (array($subjectId => $studentGrade) Eg. array(de52cabd871248ebd540e4c1616d8477 => 'A'))
     * 
     * @return Illuminate\Database\Eloquent\Collection
     */
    public function getRecommendations(string $careerPathId, array $studentResults)
    {
        return Program::query()->whereHas('career_paths', function ($query) use ($careerPathId) {
            $query->where('career_paths.id', $careerPathId);
        })->whereHas('subjects', function ($query) use ($studentResults) {
            $query->where(function ($query) use ($studentResults) {
                $i = 0;
                foreach ($studentResults as $subjectId => $studentGrade) {
                    if($i == 0){
                        $query->where(function ($query) use ($subjectId, $studentGrade) {
                                $query->where('subjects.id', $subjectId)
                                    ->whereColumn('entry_requirements.min_grade', '>=', DB::raw("'".$studentGrade."'"));
                        });
                    }else{  
                        $query->orWhere(function ($query) use ($subjectId, $studentGrade) {
                                $query->where('subjects.id', $subjectId)
                                    ->whereColumn('entry_requirements.min_grade', '>=', DB::raw("'".$studentGrade."'"));
                        });
                    }
                    $i++;
                }
            });
        })->with(['institution'])->limit(10)->get();
    }
}