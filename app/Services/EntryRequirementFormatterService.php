<?php

namespace App\Services;

use App\Enums\RequirementType;
use App\Models\EntryRequirement;
use Illuminate\Database\Eloquent\Collection;

class EntryRequirementFormatterService
{
    public function format(EntryRequirement $requirement): string
    {
        $subjectRequirements = $requirement->subjects()->get();

        // Group by Pass Level
        $principal = $subjectRequirements->where('pivot.min_grade', '<>', 'S')->where('pivot.min_grade', '<>', 'F');
        $subsidiary = $subjectRequirements->where('pivot.min_grade', '=', 'S');

        // Group by Requirement Type
        $requiredWithPrincipalPass = $principal->where('pivot.type', RequirementType::REQUIRED->value);
        $necessaryWithPrincipalPass = $principal->where('pivot.type', RequirementType::NECESSARY->value);
        $necessaryWithSubsidiaryPass = $subsidiary->where('pivot.type', RequirementType::NECESSARY->value);
        $optionalWithPrincipalPass = $principal->where('pivot.type', RequirementType::OPTIONAL->value);
        $aboveMinimumPrincipalGrade = $principal->where('pivot.min_grade', '<>', 'E');
        $compulsoryWithPrincipalPass = $this->extractCompulsorySubjectRequirements($optionalWithPrincipalPass, $requiredWithPrincipalPass);

        $output = [];

        // Principal Passes (Required and/or Optional Subjects)
        if ($principal->count() > 0) {
            $requiredWithPrincipalPass_subjects = $requiredWithPrincipalPass->map(function ($reqSubject) { return $reqSubject->name; })->toArray();
            $optionalWithPrincipalPass_subjects = $optionalWithPrincipalPass->map(function ($reqSubject) { return $reqSubject->name; })->toArray();
            // There are only Required Subjects in the Requirements
            if($requiredWithPrincipalPass->count() > 1 && $optionalWithPrincipalPass->count() <= 0){
                $plural = $requirement->required_subjects_count > 1 ? 'passes' : 'pass';
                $output[] = ucwords($this->numberToWords($requirement->required_subjects_count)) . " principal {$plural} in " .
                                $this->joinPhrases($requiredWithPrincipalPass_subjects, "and") . '.';
            }else{
                // There are Required Subject(s) and several Optional Subjects (Distinct Groups)
                if($compulsoryWithPrincipalPass->count() > 0 && $optionalWithPrincipalPass->count() > 0){
                    $compulsoryWithPrincipalPass_subjects = $compulsoryWithPrincipalPass->map(function ($reqSubject) { return $reqSubject->name; })->toArray();
                    $plural = $requirement->required_subjects_count > 1 ? 'passes' : 'pass';
                    $output[] = ucwords($this->numberToWords($requirement->required_subjects_count)) . " principal {$plural} in " .
                                    $this->joinPhrases($compulsoryWithPrincipalPass_subjects, ", ") . " and either " . 
                                    $this->joinPhrases($optionalWithPrincipalPass_subjects) . ".";
                }else{
                    // The are Optional subjects and probably Required subjects in the Requirements
                    if ($optionalWithPrincipalPass->count() > 0) {
                        $plural = $requirement->required_subjects_count > 1 ? 'passes' : 'pass';
                        $output[] = ucwords($this->numberToWords($requirement->required_subjects_count)) . " principal {$plural} in any of the following subjects: " .
                                    $this->joinPhrases($optionalWithPrincipalPass_subjects) . ".";
                        if($requiredWithPrincipalPass->count() > 0){
                            $output[] = " One of the " . $this->numberToWords($requirement->required_subjects_count) . " principal {$plural} must be in " .
                                        $this->joinPhrases($requiredWithPrincipalPass_subjects) . ".";
                        }
                    }
                }
            }

            // Minimum Total Points
            if ($requirement->min_total_points > 1) {
                $output[] = " With a minimum of {$requirement->min_total_points} points.";
            }
        }

        // Above Minimum-Principal-Grade Requirement-Subjects
        if ($aboveMinimumPrincipalGrade->count() > 0) {
            $grade_A_subjects = $aboveMinimumPrincipalGrade->where('pivot.min_grade', '=', 'A')->map(function ($reqSubject) { return $reqSubject->name; });
            $grade_B_subjects = $aboveMinimumPrincipalGrade->where('pivot.min_grade', '=', 'B')->map(function ($reqSubject) { return $reqSubject->name; });
            $grade_C_subjects = $aboveMinimumPrincipalGrade->where('pivot.min_grade', '=', 'C')->map(function ($reqSubject) { return $reqSubject->name; });
            $grade_D_subjects = $aboveMinimumPrincipalGrade->where('pivot.min_grade', '=', 'D')->map(function ($reqSubject) { return $reqSubject->name; });
            $conjugate_following_sentence = false;
            if($grade_A_subjects->count() > 0){
                $output[] = " A minimum of A grade in " . $this->joinPhrases($grade_A_subjects->toArray(), "and");
                $conjugate_following_sentence = true;
            }
            if($grade_B_subjects->count() > 0){
                $output[] = ($conjugate_following_sentence) ? " and a" : " A";
                $output[] = " minimum of B grade in " . $this->joinPhrases($grade_B_subjects->toArray(), "and");
                $conjugate_following_sentence = true;
            }
            if($grade_C_subjects->count() > 0){
                $output[] = ($conjugate_following_sentence) ? " and a" : " A";
                $output[] = " minimum of C grade in " . $this->joinPhrases($grade_C_subjects->toArray(), "and");
                $conjugate_following_sentence = true;
            }
            if($grade_D_subjects->count() > 0){
                $output[] = ($conjugate_following_sentence) ? " and a" : " A";
                $output[] = " minimum of D grade in " . $this->joinPhrases($grade_D_subjects->toArray(), "and");
            }
        }

        // Addional Requirement-Subjects (with Principal and/or Subsidiary level Passes)
        if($necessaryWithPrincipalPass->count() > 0 || $necessaryWithSubsidiaryPass->count() > 0){
            $output[] = " In addition, an applicant must have ";
            if ($necessaryWithPrincipalPass->count() > 0) {
                $necessaryWithPrincipalPass_subjects = $necessaryWithPrincipalPass->map(function ($reqSubject) { return $reqSubject->name; });
                $output[] = "a principal pass in " . $this->joinPhrases($necessaryWithPrincipalPass_subjects->toArray());
            }
            
            if ($necessaryWithSubsidiaryPass->count() > 0) {
                $necessaryWithSubsidiaryPass_subjects = $necessaryWithSubsidiaryPass->map(function ($reqSubject) { return $reqSubject->name; });
                if($necessaryWithPrincipalPass->count() > 0){
                    $output[] = " or a subsidiary level pass in " . $this->joinPhrases($necessaryWithSubsidiaryPass_subjects->toArray()) . ".";
                }else{
                    $output[] = " at least a subsidiary level pass in " . $this->joinPhrases($necessaryWithSubsidiaryPass_subjects->toArray()) . ".";
                }
            }
        }

        return implode(' ', $output);
    }

    private function joinPhrases(array $items, $conjuncture = "or"): string
    {
        $items = array_values($items);
        $count = count($items);
        if ($count === 0) return '';
        if ($count === 1) return "{$items[0]}";
        if ($count === 2) return "{$items[0]} {$conjuncture} {$items[1]}";

        return implode(', ', array_slice($items, 0, -1)) . " {$conjuncture} " . end($items);
    }

    private function numberToWords($num): string 
    {
        if(!$num) return 'Invalid Number';
        $ones = [
            0 => 'zero', 1 => 'one', 2 => 'two', 3 => 'three',
            4 => 'four', 5 => 'five', 6 => 'six', 7 => 'seven',
            8 => 'eight', 9 => 'nine', 10 => 'ten', 11 => 'eleven',
            12 => 'twelve', 13 => 'thirteen', 14 => 'fourteen',
            15 => 'fifteen', 16 => 'sixteen', 17 => 'seventeen',
            18 => 'eighteen', 19 => 'nineteen'
        ];

        $tens = [
            2 => 'twenty', 3 => 'thirty', 4 => 'forty', 5 => 'fifty',
            6 => 'sixty', 7 => 'seventy', 8 => 'eighty', 9 => 'ninety'
        ];

        if ($num < 0 || $num > 999999) {
            return 'Number out of supported range';
        }

        if ($num < 20) {
            return $ones[$num];
        } elseif ($num < 100) {
            $ten = intdiv($num, 10);
            $rest = $num % 10;
            return $tens[$ten] . ($rest ? '-' . $ones[$rest] : '');
        } elseif ($num < 1000) {
            $hundred = intdiv($num, 100);
            $rest = $num % 100;
            return $ones[$hundred] . ' hundred' . ($rest ? ' and ' . $this->numberToWords($rest) : '');
        } else {
            $thousand = intdiv($num, 1000);
            $rest = $num % 1000;
            return $this->numberToWords($thousand) . ' thousand' . ($rest ? ($rest < 100 ? ' and ' : ' ') . $this->numberToWords($rest) : '');
        }
    } 

    /**
     * Extract Compulsory Subject-Requirements (Check if there are required subjects that don't appear in the optional subjects group)
     * 
     * @param \Illuminate\Database\Eloquent\Collection<int, \Illuminate\Database\Eloquent\Model> $needleCollection (Optional Subjects Group)
     * @param \Illuminate\Database\Eloquent\Collection<int, \Illuminate\Database\Eloquent\Model> $haystackCollection (Required Subjects Group)
     * 
     * @return \Illuminate\Database\Eloquent\Collection<int, \Illuminate\Database\Eloquent\Model>
     */
    private function extractCompulsorySubjectRequirements($needleCollection, $haystackCollection): Collection
    {
        $needles = $needleCollection->pluck('id')->toArray();
        return $haystackCollection->reject(function ($item) use ($needles) {
            return in_array($item->id, $needles);
        });
    }
}