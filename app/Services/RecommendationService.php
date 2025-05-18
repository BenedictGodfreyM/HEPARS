<?php

namespace App\Services;

use App\Enums\RequirementType;
use App\Models\EntryRequirement;
use App\Models\Program;

class RecommendationService
{
    public function __construct() {}

    /**
     * Request a list of programs and institutions they are offered based on the career choice and high school results
     *
     * @param string $career_id ID of selected career
     * @param array $careers Array of career IDs (Careers in the same Field as the selected Career)
     * @param array $studentResults (array($subjectId => $studentGrade) Eg. array(de52cabd871248ebd540e4c1616d8477 => 'A'))
     * 
     * @return array<string, Illuminate\Database\Eloquent\Collection<int, App\Models\Program>>
     */
    public function getRecommendations(string $career_id, array $careers, array $studentResults): array
    {
        $programs = Program::query()->whereHas('careers', function ($query) use ($careers) {
            $query->whereIn('careers.id', $careers);
        })->with(['careers','institution','entryRequirements'])->get();

        $recommendedPrograms = $programs->filter(function ($program) use ($studentResults) {
            return $program->entryRequirements->contains(function ($requirement) use ($studentResults) {
                if (!$requirement) return false;
                return $this->studentResultsMeetsRequirement($requirement, $studentResults);
            });
        });

        $recommendations['BasedOnSelectedCareer'] = $recommendedPrograms->filter(function ($program) use ($career_id) {
            return $program->careers->contains(function ($career) use ($career_id) { 
                return $career->id === $career_id;
            });
        })->sort(function ($a, $b) { return $a->institution->rank <=> $b->institution->rank; });

        $recommendations['BasedOnRelatedCareers'] = $recommendedPrograms->reject(function ($program) use ($career_id) {
            return $program->careers->contains(function ($career) use ($career_id) { 
                return $career->id === $career_id;
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
}