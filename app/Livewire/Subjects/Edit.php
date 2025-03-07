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

    public function mount($subject_id)
    {
        $this->subjectId = $subject_id;
        $subjectRepo = new SubjectRepository();
        $subjectDetails = $subjectRepo->findSubject($subject_id);
        $this->name = $subjectDetails->name;
        $this->code = $subjectDetails->code;
    }

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
 
    public function updateSubject()
    {
        $this->validate(); 
        try{
            DB::beginTransaction();
            $subjectRepo = new SubjectRepository();
            $subjectRepo->updateSubject([
                'name' => $this->name,
                'code' => $this->code,
            ], $this->subjectId);
            DB::commit();
            session()->flash('success','Subject is successfully updated.');
        }catch(Exception $e){
            DB::rollBack();
            session()->flash('error',$e->getMessage());
        }      
    }

    public function render()
    {
        return view('livewire.subjects.edit');
    }
}
