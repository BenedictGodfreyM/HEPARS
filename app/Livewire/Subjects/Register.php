<?php

namespace App\Livewire\Subjects;

use App\Repositories\SubjectRepository;
use Exception;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Register extends Component
{
    public $name = "";
    public $code = "";

    public function rules()
    {
        return [
            'name' => ['required', 'string'],
            'code' => ['required', 'string'],
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Please insert the name of the subject.',
            'name.string' => 'The name of the subject should be in alphanumeric characters.',
            'code.required' => 'Please insert the code of the subject.',
            'code.string' => 'The code of the subject should be in alphanumeric characters.',
        ];
    }
 
    public function registerSubject()
    {
        $this->validate(); 
        try{
            DB::beginTransaction();
            (new SubjectRepository())->storeSubject([
                'name' => $this->name,
                'code' => $this->code,
            ]);
            DB::commit();
            $this->reset();
            $this->dispatch("flash-alert", type: "success", title: "Success", message: "Subject is successfully registered!.");
        }catch(Exception $e){
            DB::rollBack();
            $this->dispatch("flash-alert", type: "error", title: "Error", message: $e->getMessage()); 
        }      
    }

    public function render()
    {
        return view('livewire.subjects.register');
    }
}
