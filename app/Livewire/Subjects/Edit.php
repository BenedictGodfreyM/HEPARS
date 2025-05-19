<?php

namespace App\Livewire\Subjects;

use App\Repositories\SubjectRepository;
use Exception;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Edit extends Component
{
    public $subjectId = "";
    public $name = "";
    public $code = "";
    public $is_compulsory = false;
    public $is_additional = false;

    public function mount($subject_id)
    {
        $this->subjectId = $subject_id;
        $subjectDetails = (new SubjectRepository())->findSubject($subject_id);
        $this->name = $subjectDetails->name;
        $this->code = $subjectDetails->code;
        $this->is_compulsory = $subjectDetails->is_compulsory;
        $this->is_additional = $subjectDetails->is_additional;
    }

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
 
    public function updateSubject()
    {
        $this->validate(); 
        try{
            DB::beginTransaction();
            (new SubjectRepository())->updateSubject([
                'name' => $this->name,
                'code' => $this->code,
                'is_compulsory' => $this->is_compulsory,
                'is_additional' => $this->is_additional,
            ], $this->subjectId);
            DB::commit();
            $this->dispatch("flash-alert", type: "success", title: "Success", message: "Subject is successfully updated!.");
        }catch(Exception $e){
            DB::rollBack();
            $this->dispatch("flash-alert", type: "error", title: "Error", message: $e->getMessage());
        }      
    }

    public function render()
    {
        return view('livewire.subjects.edit');
    }
}
