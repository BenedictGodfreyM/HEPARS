<?php

namespace App\Livewire;

use App\Repositories\CareerPathRepository;
use App\Repositories\SubjectRepository;
use App\Services\RecommendationService;
use Exception;
use Livewire\Component;

class ProgramRecommender extends Component
{
    public $availableSubjects;
    public $availableGrades = ['A','B','C','D','E','F'];

    public $selectedSubjects = [];
    public $selectedCareerPath = "";

    public $recommendations = [];

    public $selectedOption = '';

    public function mount()
    {
        $subjectRepo = new SubjectRepository();
        $this->availableSubjects = $subjectRepo->allSubjectsWithoutPagination();
    }

    public function rules()
    {
        return [
            'selectedSubjects' => 'required|array|min:3',
            'selectedCareerPath' => 'required|string|exists:career_paths,id',
        ];
    }

    public function messages()
    {
        return [
            'selectedSubjects.required' => 'Please select subjects from your high school combination.',
            'selectedSubjects.array' => 'Invalid format of the selected subjects.',
            'selectedSubjects.min' => 'Please select atleast three subjects from your high school combination.',
            'selectedCareerPath.required' => 'Please select a career of your choice.',
            'selectedCareerPath.string' => 'Invalid format of the selected career choice.',
            'selectedCareerPath.exists' => 'Invalid career choice.',
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

    public function getRecommendations()
    {
        $this->validate();
        try{
            $studentResults = array();
            foreach($this->selectedSubjects as $key => $selectedSubject){
                $studentResults[$selectedSubject['subject']['id']] = $selectedSubject['grade'];
            }
            $this->recommendations = (new RecommendationService)->getRecommendations($this->selectedCareerPath, $studentResults);
            if(count($this->recommendations) <= 0) session()->flash('no_recommenadations', "Our algorithm could not generate any recommendations for you!. Try selecting an alternative career choice, if there is any.");
        }catch(Exception $e){
            session()->flash('error',$e->getMessage());
        }
    }

    public function clearRecommendations()
    {
        $this->recommendations = [];
    }

    public function resetForm()
    {
        $this->reset();
        $this->selectedOption = '';
    }

    public function render()
    {
        $subjectRepo = new SubjectRepository();
        $this->availableSubjects = $subjectRepo->allSubjectsWithoutPagination();
        $careerPathsRepo = new CareerPathRepository();
        return view('livewire.program-recommender', [
            'career_paths' => $careerPathsRepo->allCareerPathsWithoutPagination()
        ]);
    }
}
