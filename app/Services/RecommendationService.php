<?php

namespace App\Services;

use App\Models\Institution;
use Illuminate\Support\Facades\DB;

class RecommendationService
{
    public function __construct() {}

    public function getRecommendations(string $careerPathId, array $studentResults)
    {
        $institutions = Institution::whereHas('programs', function ($query) use ($careerPathId, $studentResults) {
            $query->whereHas('careerPaths', function ($query) use ($careerPathId) {
                $query->where('id', $careerPathId);
            })->whereHas('entryRequirements', function ($query) use ($studentResults) {
                foreach ($studentResults as $subjectId => $studentGrade) {
                    $query->where(function ($query) use ($subjectId, $studentGrade) {
                        $query->where('subject_id', $subjectId)
                              ->whereColumn('min_grade', '<=', DB::raw($studentGrade));
                    });
                }
            });
        })->with([
            'programs' => function ($query) use ($studentResults) {
                $query->selectRaw('programs.*, SUM(CASE WHEN student_grades.grade >= entry_requirements.min_grade THEN student_grades.grade - entry_requirements.min_grade ELSE 0 END) as qualification_score')
                      ->leftJoinSub(collect($studentResults)->map(function ($grade, $subjectId) {
                          return ['subject_id' => $subjectId, 'grade' => $grade];
                      })->toArray(), 'student_grades', function ($join) {
                          $join->on('student_grades.subject_id', '=', 'entry_requirements.subject_id');
                      })
                      ->leftJoin('entry_requirements', 'programs.id', '=', 'entry_requirements.program_id')
                      ->groupBy('programs.id')
                      ->orderByDesc('qualification_score')
                      ->limit(4);
            }
        ])->get();
    
        return $institutions->pluck('programs')->flatten();
    }
}