<?php

namespace App\Livewire\Programs;

use App\Enums\RequirementType;
use App\Repositories\CareerRepository;
use App\Repositories\EntryRequirementRepository;
use App\Repositories\ProgramRepository;
use App\Repositories\SubjectRepository;
use Exception;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Edit extends Component
{
    public $name = "";
    public $duration = "";
    public $min_total_points = "";
    public $required_subjects_count = "";

    public $availableSubjects;
    public $availableGrades = ['A','B','C','D','E','S','F'];

    public $selectedCareers = [];
    public $selectedSubjects = [];

    public $institution_id = "";
    public $program_id = "";

    public $selectedOption = '';

    public function mount($institution_id, $program_id)
    {
        $this->institution_id = $institution_id;
        session()->put('institution_id', $institution_id);
        $this->program_id = $program_id;
        session()->put('program_id', $program_id);
        $programRepo = new ProgramRepository();
        $programDetails = $programRepo->findProgram($program_id);
        $this->name = $programDetails->name;
        $this->duration = $programDetails->duration;
        $subjectRepo = new SubjectRepository();
        $this->availableSubjects = $subjectRepo->allSubjectsWithoutPagination();
        foreach($programDetails->entryRequirements as $entryRequirement){
            $this->min_total_points = $entryRequirement->min_total_points;
            $this->required_subjects_count = $entryRequirement->required_subjects_count;
            foreach($entryRequirement->subjects as $index => $subject){
                $this->addSubjectToSelection($subject->id);
                $this->updateSelectedSubject($index, $subject->pivot->min_grade);
                $this->markSelectedSubjectRequirementType($index, $subject->pivot->type);
            }
        }
        foreach($programDetails->careers as $index => $career){
            array_push($this->selectedCareers, $career->id);
        }
    }

    public function rules()
    {
        return [
            'name' => ['required', 'string'],
            'duration' => ['required', 'integer', 'min:1', 'max:10'],
            'min_total_points' => ['required', 'integer', 'min:1', 'max:20'],
            'required_subjects_count' => ['required', 'integer', 'min:1', 'max:10'],
            'selectedCareers' => 'required|array|min:1',
            'selectedCareers.*' => 'exists:careers,id',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Please insert the name of the program.',
            'name.string' => 'The name of the program should be in alphanumeric characters.',
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
            'selectedCareers.required' => 'Please select careers associated with the program.',
            'selectedCareers.array' => 'Invalid format of the selected careers.',
            'selectedCareers.min' => 'Please select atleast one careers associated with the program.',
            'selectedCareers.*.exists' => 'Invalid career selection.',
        ];
    }

    private function subjectExists($subjects, $targetSubjectName)
    {
        foreach($subjects as $subject){
            if(isset($subject['subject']['name']) && $subject['subject']['name'] === $targetSubjectName){
                return true;
            }
        }
        return false;
    }

    public function addSubjectToSelection($subjectID)
    {
        $subject = call_user_func_array('array_merge', array_filter($this->availableSubjects->toArray(), function($subject) use ($subjectID) { return $subject['id'] === $subjectID; }));
        $selectionToAdd = ['subject' => $subject, 'grade' => '', 'type' => RequirementType::OPTIONAL->value];
        // if (!$this->subjectExists($this->selectedSubjects, $selectionToAdd['subject']['name'])) {
            $this->selectedSubjects[] = $selectionToAdd;
        // }
        $this->selectedOption = '';
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
        if($this->duplicateSubjectRequirementsFound($this->selectedSubjects)) return session()->flash('error','Duplicate subject requirements.');
        try{
            DB::beginTransaction();
            $programRepo = new ProgramRepository();
            $isUpdated = $programRepo->updateProgram([
                'institution_id' => $this->institution_id,
                'name' => $this->name,
                'duration' => $this->duration,
            ], $this->program_id);

            if($isUpdated){
                $programRepo->linkToCareers($this->program_id, $this->selectedCareers);

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
                session()->flash('success','Program is successfully updated.');
            }else{
                DB::rollBack();
                session()->flash('error', 'Unable to update program details! Try again later.');  
            }
        }catch(Exception $e){
            DB::rollBack();
            session()->flash('error',$e->getMessage());
        }
    }

    public function render()
    {
        $subjectRepo = new SubjectRepository();
        $this->availableSubjects = $subjectRepo->allSubjectsWithoutPagination();
        $careersRepo = new CareerRepository();
        return view('livewire.programs.edit', [
            'institutionId' => session()->get('institution_id', ''),
            'programId' => session()->get('program_id', ''),
            'careers' => $careersRepo->allCareersWithoutPagination()
        ]);
    }
}
