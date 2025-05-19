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
    public $is_compulsory = false;
    public $is_additional = false;

    public function rules()
    {
        return [
            'name' => ['required', 'string'],
            'code' => ['required', 'string'],
            'is_compulsory' => ['required','boolean'],
            'is_additional' => ['required','boolean'],
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Please insert the name of the subject.',
            'name.string' => 'The name of the subject should be in alphanumeric characters.',
            'code.required' => 'Please insert the code of the subject.',
            'code.string' => 'The code of the subject should be in alphanumeric characters.',
            'is_compulsory.required' => 'Please specify if this subject is compulsory.',
            'is_compulsory.boolean' => 'This field must be checked as true or false.',
            'is_additional.required' => 'Please specify if this is an additional subject.',
            'is_additional.boolean' => 'This field must be checked as true or false.',
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
                'is_compulsory' => $this->is_compulsory,
                'is_additional' => $this->is_additional,
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
