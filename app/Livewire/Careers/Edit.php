<?php

namespace App\Livewire\Careers;

use App\Repositories\CareerRepository;
use Exception;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Edit extends Component
{
    public $careerId = "";
    public $name = "";

    public $discipline_id = "";

    public function mount($discipline_id, $career_id)
    {        
        $this->discipline_id = $discipline_id;
        session()->put('discipline_id', $discipline_id);
        $this->careerId = $career_id;
        session()->put('career_id', $career_id);
        $careerRepo = new CareerRepository();
        $careerDetails = $careerRepo->findCareer($career_id);
        $this->name = $careerDetails->name;
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
 
    public function updateCareer()
    {
        $this->validate(); 
        try{
            DB::beginTransaction();
            $careerRepo = new CareerRepository();
            $careerRepo->updateCareer([
                'discipline_id' => $this->discipline_id,
                'name' => $this->name,
            ], $this->careerId);
            DB::commit();
            session()->flash('success','Career is successfully updated.');
        }catch(Exception $e){
            DB::rollBack();
            session()->flash('error',$e->getMessage());
        }      
    }

    public function render()
    {
        return view('livewire.careers.edit', [
            'disciplineId' => session()->get('discipline_id', ''),
        ]);
    }
}
