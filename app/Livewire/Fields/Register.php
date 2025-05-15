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
            $fieldRepo = new FieldRepository();
            $newField = $fieldRepo->storeField([
                'name' => strtoupper($this->name),
            ]);
            DB::commit();
            $this->reset();
            session()->flash('success','Field is successfully registered.');
        }catch(Exception $e){
            DB::rollBack();
            session()->flash('error',$e->getMessage());
        }      
    }

    public function render()
    {
        return view('livewire.fields.register');
    }
}
