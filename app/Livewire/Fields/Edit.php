<?php

namespace App\Livewire\Fields;

use App\Repositories\FieldRepository;
use Exception;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Edit extends Component
{
    public $field_id = "";
    public $name = "";

    public function mount($field_id)
    {
        $this->field_id = $field_id;
        session()->put('field_id', $field_id);
        $fieldDetails = (new FieldRepository())->findField($field_id);
        $this->name = $fieldDetails->name;
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
            'name.required' => 'Please insert the name of the field.',
            'name.string' => 'The name of the field should be in alphanumeric characters.',
        ];
    }

    public function updateFieldDetails()
    {
        $this->validate(); 
        try{
            DB::beginTransaction();
            (new FieldRepository())->updateField([
                'name' => strtoupper($this->name),
            ], $this->field_id);
            DB::commit();
            $this->dispatch("flash-alert", type: "success", title: "Success", message: "Field is successfully updated!.");
        }catch(Exception $e){
            DB::rollBack();
            $this->dispatch("flash-alert", type: "error", title: "Error", message: $e->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.fields.edit');
    }
}
