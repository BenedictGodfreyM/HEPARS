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

    public $field_id = "";

    public function mount($field_id, $career_id)
    {        
        $this->field_id = $field_id;
        session()->put('field_id', $field_id);
        $this->careerId = $career_id;
        session()->put('career_id', $career_id);
        $careerDetails = (new CareerRepository())->findCareer($career_id);
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
            (new CareerRepository())->updateCareer([
                'field_id' => $this->field_id,
                'name' => $this->name,
            ], $this->careerId);
            DB::commit();
            $this->dispatch("flash-alert", type: "success", title: "Success", message: "Career is successfully updated!.");
        }catch(Exception $e){
            DB::rollBack();
            $this->dispatch("flash-alert", type: "error", title: "Error", message: $e->getMessage());
        }      
    }

    public function render()
    {
        return view('livewire.careers.edit');
    }
}
