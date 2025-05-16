<?php

namespace App\Livewire\Fields;

use App\Repositories\FieldRepository;
use Exception;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Register extends Component
{
    public $name = ""; 

    public function rules()
    {
        return [
            'name' => ['required', 'string', 'unique:fields,name'],
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Please insert the name of the field.',
            'name.string' => 'The name of the field should be in alphanumeric characters.',
            'name.unique' => 'The name of the field already exists.',
        ];
    }

    public function registerField()
    {
        $this->validate(); 
        try{
            DB::beginTransaction();
            (new FieldRepository())->storeField([
                'name' => strtoupper($this->name),
            ]);
            DB::commit();
            $this->reset();
            $this->dispatch("flash-alert", type: "success", title: "Success", message: "Field is successfully registered!.");
        }catch(Exception $e){
            DB::rollBack();
            $this->dispatch("flash-alert", type: "error", title: "Error", message: $e->getMessage()); 
        }      
    }

    public function render()
    {
        return view('livewire.fields.register');
    }
}
