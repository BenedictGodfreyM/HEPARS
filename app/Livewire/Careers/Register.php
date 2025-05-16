<?php

namespace App\Livewire\Careers;

use App\Repositories\FieldRepository;
use Exception;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Register extends Component
{
    public $name = "";

    public $field_id = "";

    public function mount($field_id)
    {
        $this->field_id = $field_id;
        session()->put('field_id', $field_id);
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
            (new FieldRepository())->addCareer([
                'name' => $this->name,
            ], $this->field_id);
            DB::commit();
            $this->reset();
            $this->dispatch("flash-alert", type: "success", title: "Success", message: "Career is successfully registered!.");
        }catch(Exception $e){
            DB::rollBack();
            $this->dispatch("flash-alert", type: "error", title: "Error", message: $e->getMessage()); 
        }      
    }

    public function render()
    {
        return view('livewire.careers.register', [
            'fieldId' => session()->get('field_id', ''),
        ]);
    }
}
