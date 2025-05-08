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

    public function mount($combination_id)
    {
        $this->combination_id = $combination_id;
        session()->put('combination_id', $combination_id);
        $combinationRepo = new CombinationRepository();
        $combinationDetails = $combinationRepo->findCombination($combination_id);
        $this->name = $combinationDetails->name;
        $subjectRepo = new SubjectRepository();
        $this->availableSubjects = $subjectRepo->allSubjectsWithoutPagination();
        foreach($combinationDetails->subjects as $index => $subject){
            array_push($this->selectedSubjects, $subject->id);
        }
    }

    public function rules()
    {
        return [
            'name' => ['required', 'string'],
            'selectedSubjects' => 'required|array|min:3',
            'selectedSubjects.*' => 'exists:subjects,id',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Please insert the name of the combination.',
            'name.string' => 'The name of the combination should be in alphanumeric characters.',
            'name.unique' => 'The name of the combination already exists.',
            'selectedSubjects.required' => 'Please select subjects associated with the combination.',
            'selectedSubjects.array' => 'Invalid format of the selected subjects.',
            'selectedSubjects.min' => 'Please select atleast three subjects associated with the combination.',
            'selectedSubjects.*.exists' => 'Invalid subject selection.',
        ];
    }

    public function updateCombinationDetails()
    {
        $this->validate(); 
        try{
            DB::beginTransaction();
            $combinationRepo = new CombinationRepository();
            $isUpdated = $combinationRepo->updateCombination([
                'name' => strtoupper($this->name),
            ], $this->combination_id);

            if($isUpdated){
                $combinationRepo->linkToSubjects($this->combination_id, $this->selectedSubjects);
                DB::commit();
                session()->flash('success','Combination is successfully updated.');
            }else{
                DB::rollBack();
                session()->flash('error', 'Unable to update combination details! Try again later.');  
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
        return view('livewire.combinations.edit');
    }
}
