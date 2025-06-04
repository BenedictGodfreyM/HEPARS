<?php

namespace App\Livewire\Combinations;

use App\Enums\CombinationCategory;
use App\Repositories\CombinationRepository;
use App\Repositories\SubjectRepository;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Livewire\Component;

class Register extends Component
{
    public $name = "";    
    public $category = "";    
    public $selectedSubjects = [];  
    public $availableSubjects;

    public $selectedOption = '';

    public function mount()
    {
        $this->availableSubjects = (new SubjectRepository())->allSubjectsWithoutPagination();
    }

    public function rules()
    {
        return [
            'name' => ['required', 'string', 'unique:combinations,name'],
            'category' => ['required', Rule::in([CombinationCategory::NATURAL_SCIENCE,CombinationCategory::ARTS])],
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Please insert the name of the combination.',
            'name.string' => 'The name of the combination should be in alphanumeric characters.',
            'name.unique' => 'The name of the combination already exists.',
            'category.required' => 'Please choose the category of the combination.',
        ];
    }

    private function subjectExists($subjects, $targetSubjectName)
    {
        foreach($subjects as $subject){
            if(isset($subject['name']) && $subject['name'] === $targetSubjectName){
                return true;
            }
        }
        return false;
    }

    public function addSubjectToSelection($subjectID)
    {
        $subject = call_user_func_array('array_merge', array_filter($this->availableSubjects->toArray(), function($subject) use ($subjectID) { 
            return $subject['id'] === $subjectID; 
        }));
        if ($this->subjectExists($this->selectedSubjects, $subject['name'])) {
            $this->dispatch("flash-alert", type: "info", title: "Info", message: "You've already selected the subject!.");
            return;
        }
        $this->selectedSubjects[] = $subject;
        $this->selectedOption = '';
    }

    public function removeSubjectFromSelection($index)
    {
        unset($this->selectedSubjects[$index]);
        $this->selectedSubjects = array_values($this->selectedSubjects);
    }

    public function registerCombination()
    {
        $this->validate(); 
        if(count($this->selectedSubjects) < 3) return $this->dispatch("flash-alert", type: "error", title: "Error", message: "Please select atleast three subjects associated with the combination!.");
        try{
            DB::beginTransaction();
            $combinationRepo = new CombinationRepository();
            $newCombination = $combinationRepo->storeCombination([
                'name' => strtoupper($this->name),
                'category' => $this->category,
            ]);
            $combinationRepo->linkToSubjects($newCombination->id, array_pluck($this->selectedSubjects, "id"));
            DB::commit();
            $this->reset();
            $this->selectedSubjects = [];
            $this->selectedOption = '';
            $this->dispatch("flash-alert", type: "success", title: "Success", message: "Combination is successfully registered!.");
        }catch(Exception $e){
            DB::rollBack();
            $this->dispatch("flash-alert", type: "error", title: "Error", message: $e->getMessage());
        }      
    }

    public function render()
    {
        $this->availableSubjects = (new SubjectRepository())->allSubjectsWithoutPagination();
        return view('livewire.combinations.register');
    }
}
