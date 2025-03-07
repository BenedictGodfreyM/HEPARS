<?php

namespace App\Livewire\CareerPaths;

use App\Repositories\CareerPathRepository;
use Exception;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Register extends Component
{
    public $name = "";

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
 
    public function registerCareerPath()
    {
        $this->validate(); 
        try{
            DB::beginTransaction();
            $careerPathRepo = new CareerPathRepository();
            $careerPathRepo->storeCareerPath([
                'name' => $this->name,
            ]);
            DB::commit();
            $this->reset();
            session()->flash('success','Career Path is successfully registered.');
        }catch(Exception $e){
            DB::rollBack();
            session()->flash('error',$e->getMessage());
        }      
    }

    public function render()
    {
        return view('livewire.career-paths.register');
    }
}
