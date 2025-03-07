<?php

namespace App\Livewire\CareerPaths;

use App\Repositories\CareerPathRepository;
use Exception;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Edit extends Component
{
    public $careerPathId = "";
    public $name = "";

    public function mount($career_path_id)
    {
        $this->careerPathId = $career_path_id;
        $careerPathRepo = new CareerPathRepository();
        $careerPathDetails = $careerPathRepo->findCareerPath($career_path_id);
        $this->name = $careerPathDetails->name;
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
 
    public function updateCareerPath()
    {
        $this->validate(); 
        try{
            DB::beginTransaction();
            $careerPathRepo = new CareerPathRepository();
            $careerPathRepo->updateCareerPath([
                'name' => $this->name,
            ], $this->careerPathId);
            DB::commit();
            session()->flash('success','Career Path is successfully updated.');
        }catch(Exception $e){
            DB::rollBack();
            session()->flash('error',$e->getMessage());
        }      
    }

    public function render()
    {
        return view('livewire.career-paths.edit');
    }
}
