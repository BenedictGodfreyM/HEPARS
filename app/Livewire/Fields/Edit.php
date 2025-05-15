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
        $fieldRepo = new FieldRepository();
        $fieldDetails = $fieldRepo->findField($field_id);
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

    public function updatefieldDetails()
    {
        $this->validate(); 
        try{
            DB::beginTransaction();
            $fieldRepo = new FieldRepository();
            $isUpdated = $fieldRepo->updateField([
                'name' => strtoupper($this->name),
            ], $this->field_id);
            DB::commit();
            session()->flash('success','Field is successfully updated.');
        }catch(Exception $e){
            DB::rollBack();
            session()->flash('error',$e->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.fields.edit');
    }
}
