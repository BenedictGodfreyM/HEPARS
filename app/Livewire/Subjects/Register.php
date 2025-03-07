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
            $subjectRepo = new SubjectRepository();
            $subjectRepo->storeSubject([
                'name' => $this->name,
                'code' => $this->code,
            ]);
            DB::commit();
            $this->reset();
            session()->flash('success','Subject is successfully registered.');
        }catch(Exception $e){
            DB::rollBack();
            session()->flash('error',$e->getMessage());
        }      
    }

    public function render()
    {
        return view('livewire.subjects.register');
    }
}
