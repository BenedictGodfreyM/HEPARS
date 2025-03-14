<?php

namespace App\Services;

use App\Enums\RequirementType;
use App\Models\Program;

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
        $programs = Program::query()->whereHas('career_paths', function ($query) use ($careerPathId) {
            $query->where('career_paths.id', $careerPathId);
        })->with(['institution','subjects'])->get();

        return $programs->filter(function ($program) use ($studentResults) {
            $compulsorySubjects = $program->subjects->filter(function($subject){
                return $subject->pivot->requirement_type === RequirementType::COMPULSORY->value;
            });
            $necessarySubjects = $program->subjects->filter(function($subject){
                return $subject->pivot->requirement_type === RequirementType::NECESSARY->value;
            });
            $optionalSubjects = $program->subjects->filter(function($subject){
                return $subject->pivot->requirement_type === RequirementType::OPTIONAL->value;
            });

            $compulsoryCount = 0;
            $necessaryCount = 0;
            $optionalCount = 0;
            $totalCompulsory = $compulsorySubjects->count();
            $totalNecessary = $necessarySubjects->count();
            $totalOptional = $optionalSubjects->count();
            $atLeastOneMet = false;

            foreach ($program->subjects as $subject) {
                if (isset($studentResults[$subject->id]) && ($studentResults[$subject->id] <= $subject->pivot->min_grade)) {
                    if ($subject->pivot->requirement_type === RequirementType::COMPULSORY->value) {
                        $compulsoryCount++;
                    } else if($subject->pivot->requirement_type === RequirementType::NECESSARY->value){
                        $necessaryCount++;
                    } else {
                        $optionalCount++;
                    }
                    $atLeastOneMet = true;
                }
            }

            // Dynamically determine the requirement type:
            if ($totalCompulsory == 0 && $totalNecessary == 0 && $totalOptional > 0) {
                return $atLeastOneMet; // If no compulsory/necessary subjects exist, at least one optional must be met.
            }

            if ($totalCompulsory > 0 && $totalNecessary == 0 && $totalOptional == 0) {
                return $compulsoryCount === $totalCompulsory; // If all subjects are compulsory, they all must be met.
            }

            if ($totalCompulsory > 0 && $totalNecessary > 0 && $totalOptional == 0) {
                return ($compulsoryCount === $totalCompulsory && $necessaryCount >= 1); // If no optional subjects exist, at least one necessary + all compulsory subjects must be met.
            }

            if ($totalCompulsory > 0 && $totalNecessary == 0 && $totalOptional > 0) {
                return ($compulsoryCount === $totalCompulsory && $optionalCount >= 1); // If no necessary subjects exist, at least one optional + all compulsory subjects must be met.
            }

            if ($totalCompulsory == 0 && $totalNecessary > 0 && $totalOptional > 0) {
                return ($necessaryCount >= 1 && $optionalCount >= 1); // If no compulsory subjects exist, at least one necessary + at least one optional subjects must be met.
            }

            if ($totalCompulsory > 0 && $totalNecessary > 0 && $totalOptional > 0) {
                return ($compulsoryCount === $totalCompulsory && $necessaryCount >= 1 && $optionalCount >= 1); // All compulsory + at least one necessary + at least one optional subjects must be met.
            }

            return false;
        })->take(10);
    }
}