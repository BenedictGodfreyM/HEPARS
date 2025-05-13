<?php

namespace App\Livewire\Careers;

use App\Repositories\CareerRepository;
use App\Repositories\DisciplineRepository;
use Exception;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Register extends Component
{
    public $name = "";

    public $discipline_id = "";

    public function mount($discipline_id)
    {
        $this->discipline_id = $discipline_id;
        session()->put('discipline_id', $discipline_id);
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
            'name.required' => 'Please insert the name of the career.',
            'name.string' => 'The name of the career should be in alphanumeric characters.',
        ];
    }
 
    public function registerCareer()
    {
        $this->validate(); 
        try{
            DB::beginTransaction();
            $disciplineRepo = new DisciplineRepository();
            $disciplineRepo->addCareer([
                'name' => $this->name,
            ], $this->discipline_id);
            DB::commit();
            $this->reset();
            session()->flash('success','Career is successfully registered.');
        }catch(Exception $e){
            DB::rollBack();
            session()->flash('error',$e->getMessage());
        }      
    }

    public function render()
    {
        return view('livewire.careers.register', [
            'disciplineId' => session()->get('discipline_id', ''),
        ]);
    }
}
