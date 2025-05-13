<?php

namespace App\Livewire\Disciplines;

use App\Repositories\DisciplineRepository;
use Exception;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Edit extends Component
{
    public $discipline_id = "";
    public $name = "";

    public function mount($discipline_id)
    {
        $this->discipline_id = $discipline_id;
        session()->put('discipline_id', $discipline_id);
        $disciplineRepo = new DisciplineRepository();
        $disciplineDetails = $disciplineRepo->findDiscipline($discipline_id);
        $this->name = $disciplineDetails->name;
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
            'name.required' => 'Please insert the name of the discipline.',
            'name.string' => 'The name of the discipline should be in alphanumeric characters.',
        ];
    }

    public function updateDisciplineDetails()
    {
        $this->validate(); 
        try{
            DB::beginTransaction();
            $disciplineRepo = new DisciplineRepository();
            $isUpdated = $disciplineRepo->updateDiscipline([
                'name' => strtoupper($this->name),
            ], $this->discipline_id);
            DB::commit();
            session()->flash('success','Discipline is successfully updated.');
        }catch(Exception $e){
            DB::rollBack();
            session()->flash('error',$e->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.disciplines.edit');
    }
}
