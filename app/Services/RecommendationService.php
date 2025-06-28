<?php

namespace App\Services;

use App\Enums\RequirementType;
use App\Models\Career;
use App\Models\EntryRequirement;
use App\Models\Program;
use App\Models\Recommendation;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class RecommendationService
{
    public function __construct() {}

    /**
     * Request a list of programs and institutions they are offered based on the career choice and high school results
     *
     * @param string $field_id ID of selected career field
     * @param array $studentResults (array($subjectId => $studentGrade) Eg. array(de52cabd871248ebd540e4c1616d8477 => 'A'))
     * 
     * @return array<string, Illuminate\Database\Eloquent\Collection<int, App\Models\Program>>
     */
    public function getRecommendations(string $field_id, array $studentResults): array
    {
        $programs = Program::query()->with('careers','institution','entryRequirements')->whereHas('careers')->get();

        $recommendedPrograms = $programs->filter(function ($program) use ($studentResults) {
            return $program->entryRequirements->contains(function ($requirement) use ($studentResults) {
                if (!$requirement) return false;
                return $this->studentResultsMeetsRequirement($requirement, $studentResults);
            });
        });

        $careerIDsUnderSelectedField = Career::where('field_id', $field_id)->pluck('id')->toArray();

        $recommendations['BasedOnselectedCareerField'] = $recommendedPrograms->filter(function ($program) use ($careerIDsUnderSelectedField) {
            return $program->careers->contains(function ($career) use ($careerIDsUnderSelectedField) {
                return in_array($career->id, $careerIDsUnderSelectedField);
            });
        })->sort(function ($a, $b) { return $a->institution->rank <=> $b->institution->rank; });

        $recommendations['BasedOnOtherCareerFields'] = $recommendedPrograms->reject(function ($program) use ($careerIDsUnderSelectedField) {
            return $program->careers->contains(function ($career) use ($careerIDsUnderSelectedField) {
                return in_array($career->id, $careerIDsUnderSelectedField);
            });
        })->sort(function ($a, $b) { return $a->institution->rank <=> $b->institution->rank; });

        return $recommendations;
    }

    protected function studentResultsMeetsRequirement(EntryRequirement $requirement, array $studentResults): bool
    {
        $totalPoints = 0;
        $passedSubjects = []; // Subject IDs in the Requirements' Set that a student has Passed

        /**************************************************************************************/
        /************************** START OF PRELIMINARY EVALUATION ***************************/
        /**************************************************************************************/
        foreach ($requirement->subjects as $subjectRequirement) {
            $subjectID = $subjectRequirement->id;
            $subjectType = $subjectRequirement->pivot->type;
            $minimumRequiredGrade = strtoupper($subjectRequirement->pivot->min_grade);

            // Skip this Requirement Check
            if (!isset($studentResults[$subjectID])) continue; // Student didn't take this subject
            if ($subjectType === RequirementType::NECESSARY->value) continue; // Subject should be checked after Preliminary Evaluation (Addional Requirement)

            $studentPoints = GradeService::getPoints($studentResults[$subjectID]) ?? 0;
            $minimumRequiredPoints = GradeService::getPoints($minimumRequiredGrade) ?? 0;

            // Check for Sufficient Points & Prevent Duplicate Subject IDs
            if ($studentPoints >= $minimumRequiredPoints && !in_array($subjectID, $passedSubjects)) {
                $totalPoints += $studentPoints;
                $passedSubjects[] = $subjectID;
            }
        }
        
        if (isset($requirement->required_subjects_count)) {
            // Student didn't pass (or take) as many subjects as required
            if (count($passedSubjects) < $requirement->required_subjects_count) {
                return false;
            }
        }

        if (isset($requirement->min_total_points)) {
            // Student doesn't have enough points
            if ($totalPoints < $requirement->min_total_points) {
                return false;
            }
        }
        /**************************************************************************************/
        /**************************  END OF PRELIMINARY EVALUATION  ***************************/
        /**************************************************************************************/

        // Group by Requirement Type
        $requiredWithPrincipalPass = $this->extractPrincipalWithType($requirement, RequirementType::REQUIRED->value);
        $necessaryWithPrincipalPass = $this->extractPrincipalWithType($requirement, RequirementType::NECESSARY->value);
        $necessaryWithSubsidiaryPass = $this->extractSubsidiaryWithType($requirement, RequirementType::NECESSARY->value);
        $optionalWithPrincipalPass = $this->extractPrincipalWithType($requirement, RequirementType::OPTIONAL->value);

        // Group by Requirement Type (Data with IDs only)
        $requiredWithPrincipalPassIDs = $requiredWithPrincipalPass->pluck('id')->toArray();
        $necessaryWithPrincipalPassIDs = $necessaryWithPrincipalPass->pluck('id')->toArray();
        $necessaryWithSubsidiaryPassIDs = $necessaryWithSubsidiaryPass->pluck('id')->toArray();
        $optionalWithPrincipalPassIDs = $optionalWithPrincipalPass->pluck('id')->toArray();

        $compulsoryWithPrincipalPass = $requiredWithPrincipalPass->reject(function ($item) use ($optionalWithPrincipalPassIDs) {
            return in_array($item->id, $optionalWithPrincipalPassIDs);
        });

        $principals = $requiredWithPrincipalPass->count() + $necessaryWithPrincipalPass->count() + $optionalWithPrincipalPass->count();
        $additional = $necessaryWithPrincipalPass->count() + $necessaryWithSubsidiaryPass->count();
        $passedCompulsorySubjects = $passedCompulsoryAndOptionalSubjects = $passedAdditionalSubjects = true;
        
        // Principal Passes
        if ($principals > 0) {
            // There are only Required Subjects in the Requirements
            if($requiredWithPrincipalPass->count() > 1 && $optionalWithPrincipalPass->count() <= 0){
                $passedCompulsorySubjects = $requiredWithPrincipalPass->every(function ($requiredPrincipal) use ($studentResults) {
                    if(!array_key_exists($requiredPrincipal->id,$studentResults)) return false;
                    $studentPoints = GradeService::getPoints($studentResults[$requiredPrincipal->id]) ?? 0;
                    $minimumRequiredPoints = GradeService::getPoints($requiredPrincipal->pivot->min_grade) ?? 0;
                    return ($studentPoints >= $minimumRequiredPoints);
                });
                $passedSubsiquentEvaluation = $this->hasNPrincipalPasses($studentResults, $requiredWithPrincipalPassIDs, $requirement->required_subjects_count, $requirement->min_total_points);
                if(!$passedSubsiquentEvaluation) return false;
            }else{
                // There are Required Subject(s) and several Optional Subjects (Distinct Groups)
                if($compulsoryWithPrincipalPass->count() > 0 && $optionalWithPrincipalPass->count() > 0){
                    $passedCompulsorySubjects = $compulsoryWithPrincipalPass->every(function ($compulsoryPrincipal) use ($studentResults) {
                        if(!array_key_exists($compulsoryPrincipal->id,$studentResults)) return false;
                        $studentPoints = GradeService::getPoints($studentResults[$compulsoryPrincipal->id]) ?? 0;
                        $minimumRequiredPoints = GradeService::getPoints($compulsoryPrincipal->pivot->min_grade) ?? 0;
                        return ($studentPoints >= $minimumRequiredPoints);
                    });

                    if(!$passedCompulsorySubjects) return false;

                    $passedOptionalSubjectsCount = $optionalWithPrincipalPass->sum(function ($optionalPrincipal) use ($studentResults) {
                        if(!array_key_exists($optionalPrincipal->id,$studentResults)) return 0;
                        $studentPoints = GradeService::getPoints($studentResults[$optionalPrincipal->id]) ?? 0;
                        $minimumRequiredPoints = GradeService::getPoints($optionalPrincipal->pivot->min_grade) ?? 0;
                        return ($studentPoints >= $minimumRequiredPoints ? 1 : 0);
                    });
                    
                    // Check if cummulated points are sufficient
                    $passedCompulsoryAndOptionalSubjects = (($compulsoryWithPrincipalPass->count() + $passedOptionalSubjectsCount) >= $requirement->required_subjects_count);
                }else{
                    // There are Optional subjects and probably Required subjects in the Requirements
                    if ($optionalWithPrincipalPass->count() > 0) {
                        $passedCompulsorySubjectCount = 0;
                        if($requiredWithPrincipalPass->count() > 0){
                            $passedCompulsorySubjects = $requiredWithPrincipalPass->contains(function ($requiredOPrincipal) use ($studentResults) {
                                if(!array_key_exists($requiredOPrincipal->id,$studentResults)) return false;
                                $studentPoints = GradeService::getPoints($studentResults[$requiredOPrincipal->id]) ?? 0;
                                $minimumRequiredPoints = GradeService::getPoints($requiredOPrincipal->pivot->min_grade) ?? 0;
                                return ($studentPoints >= $minimumRequiredPoints);
                            });
                            if($passedCompulsorySubjects) $passedCompulsorySubjectCount = 1;
                        }

                        $passedOptionalSubjectsCount = $optionalWithPrincipalPass->sum(function ($optionalPrincipal) use ($studentResults) {
                            if(!array_key_exists($optionalPrincipal->id,$studentResults)) return 0;
                            $studentPoints = GradeService::getPoints($studentResults[$optionalPrincipal->id]) ?? 0;
                            $minimumRequiredPoints = GradeService::getPoints($optionalPrincipal->pivot->min_grade) ?? 0;
                            return ($studentPoints >= $minimumRequiredPoints ? 1 : 0);
                        });
                        $passedCompulsoryAndOptionalSubjects = (($passedCompulsorySubjectCount + $passedOptionalSubjectsCount) >= $requirement->required_subjects_count);
                    }
                }
            }
        }

        // Addional Subjects in Requirements' Set
        if($additional > 0){
            $passedNecessaryPrincipal = $passedNecessarySubsidiary = true;
            if ($necessaryWithPrincipalPass->count() > 0) {
                $passedNecessaryPrincipal = $necessaryWithPrincipalPass->contains(function ($necessaryPrincipal) use ($studentResults) {
                    if(!array_key_exists($necessaryPrincipal->id,$studentResults)) return false;
                    $studentPoints = GradeService::getPoints($studentResults[$necessaryPrincipal->id]) ?? 0;
                    $minimumRequiredPoints = GradeService::getPoints($necessaryPrincipal->pivot->min_grade) ?? 0;
                    return ($studentPoints >= $minimumRequiredPoints);
                });
            }
            if ($necessaryWithSubsidiaryPass->count() > 0) {
                $passedNecessarySubsidiary = $necessaryWithSubsidiaryPass->contains(function ($necessarySubsidiary) use ($studentResults) {
                    if(!array_key_exists($necessarySubsidiary->id,$studentResults)) return false;
                    $studentPoints = GradeService::getPoints($studentResults[$necessarySubsidiary->id]) ?? 0;
                    $minimumRequiredPoints = GradeService::getPoints($necessarySubsidiary->pivot->min_grade) ?? 0;
                    return ($studentPoints >= $minimumRequiredPoints);
                });
            }
            $passedAdditionalSubjects = ($passedNecessaryPrincipal && $passedNecessarySubsidiary);
        }
        
        return ($passedCompulsorySubjects && $passedCompulsoryAndOptionalSubjects && $passedAdditionalSubjects);
    }

    private function hasNPrincipalPasses(array $studentResults, array $requiredPrincipals, int $totalRequiredPrincipals, int $minTotalPoints):bool
    {
        if($totalRequiredPrincipals == 2) return $this->hasTwoPrincipalPasses($studentResults, $requiredPrincipals, $minTotalPoints);
        if($totalRequiredPrincipals == 3) return $this->hasThreePrincipalPasses($studentResults, $requiredPrincipals, $minTotalPoints);
        return false;
    }

    private function hasTwoPrincipalPasses(array $studentResults, array $requiredPrincipals, int $minTotalPoints): bool
    {
        $found = false;
        for ($i = 0; $i < count($requiredPrincipals); $i++) {
            for ($j = $i + 1; $j < count($requiredPrincipals); $j++) {
                $index1 = $requiredPrincipals[$i];
                $index2 = $requiredPrincipals[$j];

                $totalPoints = GradeService::getPoints($studentResults[$index1]) + GradeService::getPoints($studentResults[$index2]);
                if (isset($studentResults[$index1], $studentResults[$index2]) && $totalPoints >= $minTotalPoints) {
                    $found = true;
                    break 2;
                }
            }
        }

        return $found;
    }

    private function hasThreePrincipalPasses(array $studentResults, array $requiredPrincipals, int $minTotalPoints): bool
    {
        $found = false;
        for ($i = 0; $i < count($requiredPrincipals); $i++) {
            for ($j = $i + 1; $j < count($requiredPrincipals); $j++) {
                for ($k = $j + 1; $k < count($requiredPrincipals); $k++) {
                    $index1 = $requiredPrincipals[$i];
                    $index2 = $requiredPrincipals[$j];
                    $index3 = $requiredPrincipals[$k];

                    $totalPoints = GradeService::getPoints($studentResults[$index1]) + GradeService::getPoints($studentResults[$index2]) + GradeService::getPoints($studentResults[$index3]);
                    if (isset($studentResults[$index1], $studentResults[$index2], $studentResults[$index3]) && $totalPoints >= $minTotalPoints) {
                        $found = true;
                        break 3;
                    }
                }
            }
        }

        return $found;
    }

    private function extractPrincipalWithType(EntryRequirement $requirement, string $type)
    {
        return $requirement->subjects->filter(function($subject) use ($type){
            return ($subject->pivot->min_grade != 'S' && $subject->pivot->min_grade != 'F' && $subject->pivot->type == $type);
        });
    }

    private function extractSubsidiaryWithType(EntryRequirement $requirement, string $type)
    {
        return $requirement->subjects->filter(function($subject) use ($type){
            return ($subject->pivot->min_grade === 'S' && $subject->pivot->type === $type);
        });
    }

    /**
     * Request a history of recommendations from the database (Compartible with Chart JS)
     * 
     * @return array ['data' => [], 'labels' => []]
     */
    public function getChartData(string $user_id = ""): array
    {
        $chartData = ['data' => [], 'labels' => []];

        DB::statement("SET SESSION sql_mode=(SELECT REPLACE(@@sql_mode, 'ONLY_FULL_GROUP_BY',''));");

        $recommendationModel = Recommendation::query();
        if($user_id !== "") $recommendationModel->where('user_id', $user_id);
        
        $oldest = (clone $recommendationModel)->oldest('created_at')->first();
        $newest = (clone $recommendationModel)->latest('created_at')->first();

        if(!$oldest || !$newest){
            DB::statement("SET SESSION sql_mode=(SELECT CONCAT(@@sql_mode, ',ONLY_FULL_GROUP_BY'));");
            return $chartData;
        }

        $startDate = Carbon::parse($oldest->created_at);
        $endDate = Carbon::parse($newest->created_at);
        $diffInDays = $startDate->diffInDays($endDate);

        if($diffInDays <= 7){
            $groupBy = 'day';
            $format = 'Y-m-d';
            $labelFormat = 'D, M j';
        }else if($diffInDays <= 60){
            $groupBy = 'day';
            $format = 'Y-m-d';
            $labelFormat = 'M j';
        }else if($diffInDays <= 365){
            $groupBy = 'month';
            $format = 'Y-m';
            $labelFormat = 'M Y';
        }else{
            $groupBy = 'year';
            $format = 'Y';
            $labelFormat = 'Y';
        }

        $countQuery = (clone $recommendationModel)->selectRaw("DATE_FORMAT(created_at, '%Y-%m-%d') as date, COUNT(*) as count")
                                            ->groupBy('date')
                                            ->orderBy('created_at','asc')
                                            ->orderBy('date','asc')
                                            ->get()
                                            ->groupBy(function ($item) use($groupBy){
                                                return Carbon::parse($item->date)->startOf($groupBy)->format('Y-m-d');
                                            })->map(function($group){
                                                return $group->sum('count');
                                            });

        $current = $startDate->copy()->startOf($groupBy);
        $end = $endDate->copy()->startOf($groupBy);

        while($current <= $end){
            $key = $current->format('Y-m-d');
            $chartData['labels'][] = $current->format($labelFormat);
            $chartData['data'][] = $countQuery->get($key, 0);
            $current->add(1, $groupBy);
        }
        DB::statement("SET SESSION sql_mode=(SELECT CONCAT(@@sql_mode, ',ONLY_FULL_GROUP_BY'));");

        return $chartData;
    }
}