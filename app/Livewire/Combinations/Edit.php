<?php

namespace App\Livewire\Combinations;

use App\Repositories\CombinationRepository;
use App\Repositories\SubjectRepository;
use Exception;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Edit extends Component
{
    public $combination_id = "";
    public $name = "";
    public $selectedSubjects = [];

    public $availableSubjects;

    public $selectedOption = '';

    public function mount($combination_id)
    {
        $this->combination_id = $combination_id;
        session()->put('combination_id', $combination_id);
        $combinationRepo = new CombinationRepository();
        $combinationDetails = $combinationRepo->findCombination($combination_id);
        $this->name = $combinationDetails->name;
        $this->availableSubjects = (new SubjectRepository())->allSubjectsWithoutPagination();
        foreach($combinationDetails->subjects as $index => $subject){
            $this->addSubjectToSelection($subject->id);
        }
    }

    public function rules()
    {
        return [
            'name' => ['required', 'string'],
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Please insert the name of the combination.',
            'name.string' => 'The name of the combination should be in alphanumeric characters.',
            'name.unique' => 'The name of the combination already exists.',
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

    public function updateCombinationDetails()
    {
        $this->validate(); 
        if(count($this->selectedSubjects) < 3) return $this->dispatch("flash-alert", type: "error", title: "Error", message: "Please select atleast three subjects associated with the combination!.");
        try{
            DB::beginTransaction();
            $combinationRepo = new CombinationRepository();
            $isUpdated = $combinationRepo->updateCombination([
                'name' => strtoupper($this->name),
            ], $this->combination_id);

            if($isUpdated){
                $combinationRepo->linkToSubjects($this->combination_id, array_pluck($this->selectedSubjects, "id"));
                DB::commit();
                $this->dispatch("flash-alert", type: "success", title: "Success", message: "Combination is successfully updated!.");
            }else{
                DB::rollBack();
                $this->dispatch("flash-alert", type: "error", title: "Error", message: "Unable to update combination details! Try again later.");  
            }
        }catch(Exception $e){
            DB::rollBack();
            $this->dispatch("flash-alert", type: "error", title: "Error", message: $e->getMessage());
        }
    }

    public function render()
    {
        $this->availableSubjects = (new SubjectRepository())->allSubjectsWithoutPagination();
        return view('livewire.combinations.edit');
    }
}
