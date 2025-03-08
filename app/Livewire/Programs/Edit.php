<?php

namespace App\Livewire\Programs;

use App\Repositories\CareerPathRepository;
use App\Repositories\ProgramRepository;
use App\Repositories\SubjectRepository;
use Exception;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Edit extends Component
{
    public $name = "";
    public $duration = "";

    public $availableSubjects;
    public $availableGrades = ['A','B','C','D','E','F'];

    public $selectedCareerPaths = [];
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
        foreach($programDetails->subjects as $index => $subject){
            $this->addSubjectToSelection($subject->id);
            $this->updateSelectedSubject($index, $subject->pivot->min_grade);
        }
        foreach($programDetails->career_paths as $index => $career){
            array_push($this->selectedCareerPaths, $career->id);
        }
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

    public function updateProgramDetails()
    {
        $this->validate(); 
        try{
            DB::beginTransaction();
            $programRepo = new ProgramRepository();
            $isUpdated = $programRepo->updateProgram([
                'institution_id' => $this->institution_id,
                'name' => $this->name,
                'duration' => $this->duration,
            ], $this->program_id);

            if($isUpdated){
                $programRepo->linkToCareerPaths($this->program_id, $this->selectedCareerPaths);

                $programRepo->removeEntryRequirements($this->program_id);
                foreach ($this->selectedSubjects as $selectedSubject) {
                    $programRepo->addEntryRequirement($this->program_id, $selectedSubject['subject']['id'], $selectedSubject['grade']);
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
        $careerPathsRepo = new CareerPathRepository();
        return view('livewire.programs.edit', [
            'institutionId' => session()->get('institution_id', ''),
            'programId' => session()->get('program_id', ''),
            'career_paths' => $careerPathsRepo->allCareerPathsWithoutPagination()
        ]);
    }
}
