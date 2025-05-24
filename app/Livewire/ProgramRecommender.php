<?php

namespace App\Livewire;

use App\Models\Field;
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
    public $careerFields = [];

    public $selectedSubjects = [];
    public $selectedCareer = "";

    public $recommendations = [];

    public $selectedOption = '';

    // For toggling the recommendations model
    public $showRecommendations = false;

    public function mount()
    {
        $this->availableCombinations = (new CombinationRepository())->allCombinationsWithoutPagination();
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
            'selectedSubjects.required' => 'Please select your high school combination.',
            'selectedSubjects.array' => 'Invalid format of the combination subjects.',
            'selectedSubjects.min' => 'Your high school combination should have atleast three subjects.',
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
        $this->selectedSubjects = $selectedSubjectIDs = [];
        foreach($combination->subjects as $key => $subject){
            $selectionToAdd = ['subject' => $subject, 'grade' => ''];
            if (!$this->subjectExists($this->selectedSubjects, $selectionToAdd['subject']['name'])) {
                $this->selectedSubjects[$key] = $selectionToAdd;
                $selectedSubjectIDs[$key] = $subject->id;
            }
        }
        // Retrieve Careers related to the selected subjects
        $associatedCareers = (new CareerRepository)->allCareersAssociatedWith($selectedSubjectIDs);
        // Group Careers according their fields
        $groupedCareers = $associatedCareers->groupBy(function ($associatedCareer) {
            return $associatedCareer->field->id;
        });
        $associatedCareerFields = $associatedCareers->pluck('field')->unique('id')->values();
        $associatedCareerFields->each(function ($associatedCareerField) use ($groupedCareers) {
            $associatedCareerField->setRelation('careers', $groupedCareers->get($associatedCareerField->id, collect()));
        });
        $this->careerFields = $associatedCareerFields;
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
                return session()->flash('no_recommenadations', "Your results do not quite meet the requirements for programs under the career you have selected!. Try selecting an alternative career choice, if there is any.");
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
        return view('livewire.program-recommender');
    }
}
