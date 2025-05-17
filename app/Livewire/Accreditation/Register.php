<?php

namespace App\Livewire\Accreditation;

use App\Repositories\AccreditationRepository;
use Exception;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Register extends Component
{
    public $status = "";
    public $rating = "";
    public $description = "";

    public function rules()
    {
        return [
            'status' => ['required', 'string'],
            'rating' => ['required', 'integer', 'min:1'],
            'description' => ['required', 'string'],
        ];
    }

    public function messages()
    {
        return [
            'status.required' => 'Please insert the status of accreditation.',
            'status.string' => 'The status of accreditation should be in alphanumeric characters.',
            'rating.required' => 'Please insert the rating of the accreditation status.',
            'rating.integer' => 'The rating of the accreditation status should be in digits. (Eg. 4)',
            'rating.min' => 'The rating is  one (1).',
            'description.required' => 'Please insert the description of accreditation.',
            'description.string' => 'The description of accreditation should be in alphanumeric characters.',
        ];
    }

    public function registerAccreditation()
    {
        $this->validate(); 
        try{
            DB::beginTransaction();
            (new AccreditationRepository())->storeAccreditation([
                'status' => $this->status,
                'rating' => $this->rating,
                'description' => $this->description,
            ]);
            DB::commit();
            $this->reset();
            $this->dispatch("flash-alert", type: "success", title: "Success", message: "Accreditation is successfully registered!.");
        }catch(Exception $e){
            DB::rollBack();
            $this->dispatch("flash-alert", type: "error", title: "Error", message: $e->getMessage()); 
        }      
    }

    public function render()
    {
        return view('livewire.accreditation.register');
    }
}
