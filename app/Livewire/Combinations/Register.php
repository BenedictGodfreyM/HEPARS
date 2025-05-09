<?php

namespace App\Livewire\Combinations;

use App\Repositories\CombinationRepository;
use App\Repositories\SubjectRepository;
use Exception;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Register extends Component
{
    public $name = "";    
    public $selectedSubjects = [];  

    public function rules()
    {
        return [
            'name' => ['required', 'string', 'unique:combinations,name'],
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

    public function registerCombination()
    {
        $this->validate(); 
        try{
            DB::beginTransaction();
            $combinationRepo = new CombinationRepository();
            $newCombination = $combinationRepo->storeCombination([
                'name' => strtoupper($this->name),
            ]);
            $combinationRepo->linkToSubjects($newCombination->id, $this->selectedSubjects);
            DB::commit();
            $this->reset();
            $this->selectedSubjects = [];
            session()->flash('success','Combination is successfully registered.');
        }catch(Exception $e){
            DB::rollBack();
            session()->flash('error',$e->getMessage());
        }      
    }

    public function render()
    {
        $subjectRepo = new SubjectRepository();
        return view('livewire.combinations.register',[
            'subjects' => $subjectRepo->allSubjectsWithoutPagination()
        ]);
    }
}
