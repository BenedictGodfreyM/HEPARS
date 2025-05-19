<?php

namespace App\Livewire\Programs;

use App\Enums\ProgramCompetitionScale;
use App\Enums\RequirementType;
use App\Repositories\CareerRepository;
use App\Repositories\EntryRequirementRepository;
use App\Repositories\ProgramRepository;
use App\Repositories\SubjectRepository;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Livewire\Component;

class Edit extends Component
{
    public $name = "";
    public $competition_scale = "";
    public $duration = "";
    public $min_total_points = "";
    public $required_subjects_count = "";

    public $availableCareers;
    public $availableSubjects;
    public $availableGrades = ['A','B','C','D','E','S','F'];

    public $selectedCareers = [];
    public $selectedSubjects = [];

    public $institution_id = "";
    public $program_id = "";

    public $selectedOption1 = '';
    public $selectedOption2 = '';

    public function mount($institution_id, $program_id)
    {
        $this->institution_id = $institution_id;
        session()->put('institution_id', $institution_id);
        $this->program_id = $program_id;
        session()->put('program_id', $program_id);
        $programDetails = (new ProgramRepository())->findProgram($program_id);
        $this->name = $programDetails->name;
        $this->competition_scale = $programDetails->competition_scale;
        $this->duration = $programDetails->duration;
        $this->availableSubjects = (new SubjectRepository())->allSubjectsWithoutPagination();
        foreach($programDetails->entryRequirements as $entryRequirement){
            $this->min_total_points = $entryRequirement->min_total_points;
            $this->required_subjects_count = $entryRequirement->required_subjects_count;
            foreach($entryRequirement->subjects as $index => $subject){
                $this->addSubjectToSelection($subject->id);
                $this->updateSelectedSubject($index, $subject->pivot->min_grade);
                $this->markSelectedSubjectRequirementType($index, $subject->pivot->type);
            }
        }
        $this->availableCareers = (new CareerRepository())->allCareersWithoutPagination();
        foreach($programDetails->careers as $index => $career){
            $this->addCareerToSelection($career->id);
        }
    }

    public function rules()
    {
        return [
            'name' => ['required', 'string'],
            'competition_scale' => ['required', Rule::in([ProgramCompetitionScale::HIGH_COMPETITION,ProgramCompetitionScale::MODERATE_COMPETITION,ProgramCompetitionScale::LOW_COMPETITION])],
            'duration' => ['required', 'integer', 'min:1', 'max:10'],
            'min_total_points' => ['required', 'integer', 'min:1', 'max:20'],
            'required_subjects_count' => ['required', 'integer', 'min:1', 'max:10'],
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Please insert the name of the program.',
            'name.string' => 'The name of the program should be in alphanumeric characters.',
            'competition_scale.required' => 'Please choose the competition level of the program.',
            'duration.required' => 'Please insert the duration of the program.',
            'duration.integer' => 'The duration of the program should be in number of years. (Eg. 3)',
            'duration.min' => 'The duration of the program should atleast be 1 year.',
            'duration.max' => 'The duration of the program should be atmost 10 years.',
            'min_total_points.required' => 'Please insert the minimum total points required for the program.',
            'min_total_points.integer' => 'The minimum total points required for the program should be in digits. (Eg. 4)',
            'min_total_points.min' => 'The minimum total points required for the program should be atleast 1 point.',
            'min_total_points.max' => 'The minimum total points required for the program should be atmost 20 points.',
            'required_subjects_count.required' => 'Please insert the number of required subjects.',
            'required_subjects_count.integer' => 'The number of required subjects should be in digits. (Eg. 2)',
            'required_subjects_count.min' => 'The number of required subjects should atleast be 1.',
            'required_subjects_count.max' => 'The number of required subjects should atmost be 10.',
        ];
    }

    private function careerExists($careers, $targetCareerName)
    {
        foreach($careers as $career){
            if(isset($career['career']['name']) && $career['career']['name'] === $targetCareerName){
                return true;
            }
        }
        return false;
    }

    public function addCareerToSelection($careerID)
    {
        $career = call_user_func_array('array_merge', array_filter($this->availableCareers->toArray(), function($career) use ($careerID) { 
            return $career['id'] === $careerID; 
        }));
        if ($this->careerExists($this->selectedCareers, $career['name'])) {
            $this->dispatch("flash-alert", type: "info", title: "Info", message: "You've already selected the career!.");
            return;
        }
        $this->selectedCareers[] = $career;
        $this->selectedOption1 = '';
    }

    public function removeCareerFromSelection($index)
    {
        unset($this->selectedCareers[$index]);
        $this->selectedCareers = array_values($this->selectedCareers);
    }

    public function addSubjectToSelection($subjectID)
    {
        $subject = call_user_func_array('array_merge', array_filter($this->availableSubjects->toArray(), function($subject) use ($subjectID) { return $subject['id'] === $subjectID; }));
        $selectionToAdd = ['subject' => $subject, 'grade' => '', 'type' => RequirementType::OPTIONAL->value];
        // if (!$this->subjectExists($this->selectedSubjects, $selectionToAdd['subject']['name'])) {
            $this->selectedSubjects[] = $selectionToAdd;
        // }
        $this->selectedOption2 = '';
    }

    public function removeSubjectFromSelection($index)
    {
        unset($this->selectedSubjects[$index]);
        $this->selectedSubjects = array_values($this->selectedSubjects);
    }

    public function updateSelectedSubject($index, $selectedGrade)
    {
        if (isset($this->selectedSubjects[$index])) {
            $this->selectedSubjects[$index]['grade'] = $selectedGrade;
        }
    }

    public function markSelectedSubjectRequirementType($index, $requirement_type)
    {
        if (isset($this->selectedSubjects[$index])) {
            $this->selectedSubjects[$index]['type'] = $requirement_type;
        }
    }

    public function duplicateSubjectRequirementsFound($selectedSubjects)
    {
        foreach ($selectedSubjects as &$arr) {
            ksort($arr); // Sort keys
        }
        unset($arr);
        
        $serialized = array_map('serialize', $selectedSubjects);
        $unique = array_unique($serialized);
        
        if (count($selectedSubjects) !== count($unique)) return true;

        return false;
    }

    public function updateProgramDetails()
    {
        $this->validate(); 
        if($this->duplicateSubjectRequirementsFound($this->selectedSubjects)) return $this->dispatch("flash-alert", type: "error", title: "Error", message: "Check for duplicate subject requirements!.");
        if(count($this->selectedCareers) <= 0) return $this->dispatch("flash-alert", type: "error", title: "Error", message: "Please select atleast one career associated with the program!.");
        try{
            DB::beginTransaction();
            $programRepo = new ProgramRepository();
            $isUpdated = $programRepo->updateProgram([
                'institution_id' => $this->institution_id,
                'name' => $this->name,
                'competition_scale' => $this->competition_scale,
                'duration' => $this->duration,
            ], $this->program_id);

            if($isUpdated){
                $programRepo->linkToCareers($this->program_id, array_pluck($this->selectedCareers, "id"));

                $program = $programRepo->findProgram($this->program_id);
                foreach($program->entryRequirements as $entryRequirement){
                    (new EntryRequirementRepository())->detachEntryRequirementSubjects($entryRequirement->id);
                }
                $programRepo->removeEntryRequirements($this->program_id);

                $newEntryRequirement = $programRepo->addEntryRequirement($this->program_id, [
                    'min_total_points' => $this->min_total_points,
                    'required_subjects_count' => $this->required_subjects_count,
                ]);

                $entryRequirementRepo = new EntryRequirementRepository();
                foreach ($this->selectedSubjects as $selectedSubject) {
                    $entryRequirementRepo->addEntryRequirementSubject($newEntryRequirement->id, $selectedSubject['subject']['id'], $selectedSubject['grade'], $selectedSubject['type']);
                }
                
                DB::commit();
                $this->dispatch("flash-alert", type: "success", title: "Success", message: "Program is successfully updated!.");
            }else{
                DB::rollBack();
                $this->dispatch("flash-alert", type: "error", title: "Error", message: "Unable to update program details! Try again later.");  
            }
        }catch(Exception $e){
            DB::rollBack();
            $this->dispatch("flash-alert", type: "error", title: "Error", message: $e->getMessage());
        }
    }

    public function render()
    {
        $this->availableCareers = (new CareerRepository())->allCareersWithoutPagination();
        $this->availableSubjects = (new SubjectRepository())->allSubjectsWithoutPagination();
        return view('livewire.programs.edit', [
            'institutionId' => session()->get('institution_id', ''),
            'programId' => session()->get('program_id', '')
        ]);
    }
}
