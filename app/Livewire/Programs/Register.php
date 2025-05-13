<?php

namespace App\Livewire\Programs;

use App\Enums\RequirementType;
use App\Repositories\CareerRepository;
use App\Repositories\EntryRequirementRepository;
use App\Repositories\InstitutionRepository;
use App\Repositories\ProgramRepository;
use App\Repositories\SubjectRepository;
use Exception;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Register extends Component
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

    public $selectedOption = '';

    public function mount($institution_id)
    {
        $this->institution_id = $institution_id;
        session()->put('institution_id', $institution_id);
        $subjectRepo = new SubjectRepository();
        $this->availableSubjects = $subjectRepo->allSubjectsWithoutPagination();
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
 
    public function registerProgram()
    {
        $this->validate(); 
        if($this->duplicateSubjectRequirementsFound($this->selectedSubjects)) return session()->flash('error','Duplicate subject requirements.');
        try{
            DB::beginTransaction();
            $institutionRepo = new InstitutionRepository();
            $newProgram = $institutionRepo->addProgram([
                'name' => $this->name,
                'duration' => $this->duration,
            ], $this->institution_id);

            $programRepo = new ProgramRepository();
            $programRepo->linkToCareers($newProgram->id, $this->selectedCareers);
            $newEntryRequirement = $programRepo->addEntryRequirement($newProgram->id, [
                'min_total_points' => $this->min_total_points,
                'required_subjects_count' => $this->required_subjects_count,
            ]);

            $entryRequirementRepo = new EntryRequirementRepository();
            foreach ($this->selectedSubjects as $selectedSubject) {
                $entryRequirementRepo->addEntryRequirementSubject($newEntryRequirement->id, $selectedSubject['subject']['id'], $selectedSubject['grade'], $selectedSubject['type']);
            }

            DB::commit();
            $this->reset();
            $this->selectedCareers = [];
            $this->selectedSubjects = [];
            $this->selectedOption = '';
            session()->flash('success','Program is successfully registered.');
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
        return view('livewire.programs.register', [
            'institutionId' => session()->get('institution_id', ''),
            'careers' => $careersRepo->allCareersWithoutPagination()
        ]);
    }
}
