<?php

namespace App\Livewire;

use App\Repositories\CombinationRepository;
use App\Repositories\FieldRepository;
use App\Services\RecommendationService;
use Barryvdh\DomPDF\Facade\Pdf;
use Exception;
use Livewire\Component;

class ProgramRecommender extends Component
{
    public $availableCombinations;
    public $availableGrades = ['A','B','C','D','E','F'];
    public $careerFields = [];

    public $selectedSubjects = [];
    public $selectedCareerField = "";

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
            'selectedCareerField' => 'required|string|exists:fields,id',
        ];
    }

    public function messages()
    {
        return [
            'selectedSubjects.required' => 'Please select your high school combination.',
            'selectedSubjects.array' => 'Invalid format of the combination subjects.',
            'selectedSubjects.min' => 'Your high school combination should have atleast three subjects.',
            'selectedCareerField.required' => 'Please select a career of your choice.',
            'selectedCareerField.string' => 'Invalid format of the selected career choice.',
            'selectedCareerField.exists' => 'Invalid career choice.',
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
        $this->reset('selectedCareerField');
        foreach($combination->subjects as $key => $subject){
            $selectionToAdd = ['subject' => $subject, 'grade' => ''];
            if (!$this->subjectExists($this->selectedSubjects, $selectionToAdd['subject']['name'])) {
                $this->selectedSubjects[$key] = $selectionToAdd;
                $selectedSubjectIDs[$key] = $subject->id;
            }
        }
        // Retrieve Fields related to the selected subjects
        $this->careerFields = (new FieldRepository)->allFieldsAssociatedWith($selectedSubjectIDs);
    }

    public function getRecommendations()
    {
        $this->validate();
        try{
            $studentResults = array();
            foreach($this->selectedSubjects as $key => $selectedSubject){
                $studentResults[$selectedSubject['subject']['id']] = $selectedSubject['grade'];
            }

            $this->recommendations = (new RecommendationService)->getRecommendations($this->selectedCareerField, $studentResults);
            
            if(count($this->recommendations['BasedOnselectedCareerField']) <= 0 && count($this->recommendations['BasedOnOtherCareerFields']) <= 0) {
                return session()->flash('no_recommenadations', "Your results do not quite meet the requirements for programs under the career you have selected!. Try selecting an alternative career choice, if there is any.");
            }            

            $selectedCareerField_Details = (new FieldRepository)->findField($this->selectedCareerField);
            $this->recommendations['CareerField'] = ucwords(strtolower($selectedCareerField_Details->name));
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

    public function generatePDF()
    {
        $data = [
            'student_results' => $this->selectedSubjects,
            'recommendations' => $this->recommendations
        ];
        $pdf = Pdf::loadView('layouts.recommendations-pdf', $data);
        $filename = 'Recommendations-'. now()->format('Y-m-d') . '-'. now()->format('H') .''. now()->format('i') .''. now()->format('s') .'.pdf';
        return response()->streamDownload(function() use ($pdf) {
            echo $pdf->stream();
        }, $filename);
    }

    public function render()
    {
        $this->availableCombinations = (new CombinationRepository())->allCombinationsWithoutPagination();
        return view('livewire.program-recommender');
    }
}
