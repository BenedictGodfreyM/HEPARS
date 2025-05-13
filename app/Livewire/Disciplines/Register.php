<?php

namespace App\Livewire\Disciplines;

use App\Repositories\DisciplineRepository;
use Exception;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Register extends Component
{
    public $name = ""; 

    public function rules()
    {
        return [
            'name' => ['required', 'string', 'unique:disciplines,name'],
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Please insert the name of the discipline.',
            'name.string' => 'The name of the discipline should be in alphanumeric characters.',
            'name.unique' => 'The name of the discipline already exists.',
        ];
    }

    public function registerDiscipline()
    {
        $this->validate(); 
        try{
            DB::beginTransaction();
            $disciplineRepo = new DisciplineRepository();
            $newCombination = $disciplineRepo->storeDiscipline([
                'name' => strtoupper($this->name),
            ]);
            DB::commit();
            $this->reset();
            session()->flash('success','Discipline is successfully registered.');
        }catch(Exception $e){
            DB::rollBack();
            session()->flash('error',$e->getMessage());
        }      
    }

    public function render()
    {
        return view('livewire.disciplines.register');
    }
}
