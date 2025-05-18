<?php

namespace App\Livewire;

use App\Repositories\CareerRepository;
use App\Repositories\CombinationRepository;
use App\Repositories\FieldRepository;
use App\Services\RecommendationService;
use Exception;
use Livewire\Component;

class ProgramRecommender extends Component
{
    public $availableCombinations;
    public $availableGrades = ['A','B','C','D','E','F'];

    public $selectedSubjects = [];
    public $selectedCareer = "";

    public $recommendations = [];

    public $selectedOption = '';

    // For toggling the recommendations model
    public $showRecommendations = false;

    public function mount()
    {
        $combinationRepo = new CombinationRepository();
        $this->availableCombinations = $combinationRepo->allCombinationsWithoutPagination();
    }

    public function rules()
    {
        return [
            'selectedSubjects' => 'required|array|min:3',
            'selectedCareer' => 'required|string|exists:careers,id',
        ];
    }

    public function messages()
    {
        return [
            'selectedSubjects.required' => 'Please select subjects from your high school combination.',
            'selectedSubjects.array' => 'Invalid format of the selected subjects.',
            'selectedSubjects.min' => 'Please select atleast three subjects from your high school combination.',
            'selectedCareer.required' => 'Please select a career of your choice.',
            'selectedCareer.string' => 'Invalid format of the selected career choice.',
            'selectedCareer.exists' => 'Invalid career choice.',
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

    public function addCombinationSubjectsToSelection($combinationID)
    {
        $combination = (new CombinationRepository())->findCombination($combinationID);
        $this->selectedSubjects = [];
        foreach($combination->subjects as $key => $subject){
            $selectionToAdd = ['subject' => $subject, 'grade' => ''];
            if (!$this->subjectExists($this->selectedSubjects, $selectionToAdd['subject']['name'])) {
                $this->selectedSubjects[] = $selectionToAdd;
            }
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

            $selectedCareer_Details = (new CareerRepository)->findCareer($this->selectedCareer);
            $relatedCareers = $selectedCareer_Details->field->careers->map(function ($career) { return $career->id; })->toArray();

            $this->recommendations = (new RecommendationService)->getRecommendations($this->selectedCareer, $relatedCareers, $studentResults);
            
            if(count($this->recommendations['BasedOnSelectedCareer']) <= 0 && count($this->recommendations['BasedOnRelatedCareers']) <= 0) {
                $this->resetForm();
                return session()->flash('no_recommenadations', "Our algorithm could not generate any recommendations for you!. Try selecting an alternative career choice, if there is any.");
            }
            
            $this->recommendations['CareerField'] = ucwords(strtolower($selectedCareer_Details->field->name));
            return $this->showRecommendations = true;
        }catch(Exception $e){
            session()->flash('error',$e->getMessage());
        }
    }

    public function clearRecommendations()
    {
        $this->showRecommendations = false;
        $this->recommendations = [];
        $this->resetForm();
    }

    public function resetForm()
    {
        $this->reset();
        $this->selectedSubjects = [];
        $this->selectedOption = '';
    }

    public function printRecommendations()
    {
        // 
    }

    public function render()
    {
        $this->availableCombinations = (new CombinationRepository())->allCombinationsWithoutPagination();
        return view('livewire.program-recommender', [
            'fields' => (new FieldRepository())->allFieldsWithoutPagination(),
        ]);
    }
}
