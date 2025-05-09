<?php

namespace App\Livewire\Institutions;

use App\Enums\InstitutionOwnership;
use App\Enums\InstitutionType;
use App\Repositories\InstitutionRepository;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Livewire\Component;

class Edit extends Component
{
    public $name = "";
    public $acronym = "";
    public $type = "";
    public $ownership = "";
    public $code = "";
    public $location = "";
    public $admission_portal_link = "";
    public $institutionId = "";

    public function mount($institution_id)
    {
        $this->institutionId = $institution_id;
        $institutionRepo = new InstitutionRepository();
        $institutionDetails = $institutionRepo->findInstitution($institution_id);
        $this->name = $institutionDetails->name;
        $this->acronym = $institutionDetails->acronym;
        $this->type = $institutionDetails->type;
        $this->ownership = $institutionDetails->ownership;
        $this->code = $institutionDetails->code;
        $this->location = $institutionDetails->location;
        $this->admission_portal_link = $institutionDetails->admission_portal_link;
    }

    public function rules()
    {
        return [
            'name' => ['required', 'string'],
            'acronym' => ['required', 'max:10'],
            'type' => ['required', Rule::in([InstitutionType::UNIVERSITY,InstitutionType::UNIVERSITY_CAMPUS_COLLEGE,InstitutionType::UNIVERSITY_COLLEGE,InstitutionType::NON_UNIVERSITY])],
            'ownership' => ['required', Rule::in([InstitutionOwnership::PRIVATE_INSTITUTION,InstitutionOwnership::PUBLIC_INSTITUTION])],
            'code' => ['required', 'max:5'],
            'location' => ['required', 'string'],
            'admission_portal_link' => ['required', 'string'],
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Please insert the name of the institution.',
            'name.string' => 'The name of the institution should be in alphanumeric characters.',
            'acronym.required' => 'Please insert the acronym of the institution.',
            'acronym.string' => 'The acronym of the institution should be in alphanumeric characters.',
            'type.required' => 'Please choose the type of the institution.',
            'ownership.required' => 'Please choose the form of ownership of the institution.',
            'code.required' => "Please insert the TCU's code of the institution.",
            'code.max' => "The institution's code should be 5 characters long.",
            'location.required' => 'Please insert the geographical location of the institution.',
            'location.string' => 'The geographical location of the institution should be in alphanumeric characters.',
            'admission_portal_link.required' => 'Please insert a link to the admission portal of the institution.',
            'admission_portal_link.string' => 'The link to the admission portal of the institution is invalid.',
        ];
    }
 
    public function updateInstitution()
    {
        $this->validate(); 
        try{
            DB::beginTransaction();
            $institutionRepo = new InstitutionRepository();
            $institutionRepo->updateInstitution([
                'name' => $this->name,
                'acronym' => $this->acronym,
                'type' => $this->type,
                'ownership' => $this->ownership,
                'code' => $this->code,
                'location' => $this->location,
                'admission_portal_link' => $this->admission_portal_link,
            ], $this->institutionId);
            DB::commit();
            session()->flash('success','Institution is successfully updated.');
        }catch(Exception $e){
            DB::rollBack();
            session()->flash('error',$e->getMessage());
        }      
    }

    public function render()
    {
        return view('livewire.institutions.edit');
    }
}
