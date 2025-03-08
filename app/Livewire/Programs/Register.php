<?php

namespace App\Livewire\Programs;

use App\Repositories\CareerPathRepository;
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

    public $availableSubjects;
    public $availableGrades = ['A','B','C','D','E','F'];

    public $selectedCareerPaths = [];
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
            'selectedCareerPaths' => 'required|array|min:1',
            'selectedCareerPaths.*' => 'exists:career_paths,id',
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
            'selectedCareerPaths.required' => 'Please select career paths associated with the program.',
            'selectedCareerPaths.array' => 'Invalid format of the selected career paths.',
            'selectedCareerPaths.min' => 'Please select atleast one career paths associated with the program.',
            'selectedCareerPaths.*.exists' => 'Invalid career path selection.',
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
        $selectionToAdd = ['subject' => $subject, 'grade' => ''];
        if (!$this->subjectExists($this->selectedSubjects, $selectionToAdd['subject']['name'])) {
            $this->selectedSubjects[] = $selectionToAdd;
        }
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
 
    public function registerProgram()
    {
        $this->validate(); 
        try{
            DB::beginTransaction();
            $institutionRepo = new InstitutionRepository();
            $newProgram = $institutionRepo->addProgram([
                'name' => $this->name,
                'duration' => $this->duration,
            ], $this->institution_id);

            $programRepo = new ProgramRepository();
            $programRepo->linkToCareerPaths($newProgram->id, $this->selectedCareerPaths);

            foreach ($this->selectedSubjects as $selectedSubject) {
                $programRepo->addEntryRequirement($newProgram->id, $selectedSubject['subject']['id'], $selectedSubject['grade']);
            }

            DB::commit();
            $this->reset();
            $this->selectedCareerPaths = [];
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
        $careerPathsRepo = new CareerPathRepository();
        return view('livewire.programs.register', [
            'institutionId' => session()->get('institution_id', ''),
            'career_paths' => $careerPathsRepo->allCareerPathsWithoutPagination()
        ]);
    }
}
