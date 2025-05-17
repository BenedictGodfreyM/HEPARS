<?php

namespace App\Livewire\Institutions;

use App\Enums\InstitutionOwnership;
use App\Enums\InstitutionType;
use App\Repositories\AccreditationRepository;
use App\Repositories\InstitutionRepository;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Livewire\Component;

class Edit extends Component
{
    public $affiliation_id = "";
    public $name = "";
    public $acronym = "";
    public $type = "";
    public $ownership = "";
    public $code = "";
    public $location = "";
    public $admission_portal_link = "";
    public $rank = "";
    public $institutionId = "";
    
    public $allMotherInstitutions;
    public $availableAccreditations;
    public $selectedAccreditations = [];

    public $selectedOption = '';

    public function mount($institution_id)
    {
        $this->institutionId = $institution_id;
        $institutionRepo = new InstitutionRepository();
        $institutionDetails = $institutionRepo->findInstitution($institution_id);
        $this->affiliation_id = $institutionDetails->affiliation_id;
        $this->name = $institutionDetails->name;
        $this->acronym = $institutionDetails->acronym;
        $this->type = $institutionDetails->type;
        $this->ownership = $institutionDetails->ownership;
        $this->code = $institutionDetails->code;
        $this->location = $institutionDetails->location;
        $this->admission_portal_link = $institutionDetails->admission_portal_link;
        $this->rank = $institutionDetails->rank;
        $this->allMotherInstitutions = $institutionRepo->allMotherInstitutionsExceptWithoutPagination($institution_id);
        $this->availableAccreditations = (new AccreditationRepository())->allAccreditationsWithoutPagination();
        foreach($institutionDetails->accreditations as $index => $accreditation){
            $this->addAccreditationToSelection($accreditation->id);
        }
    }

    public function rules()
    {
        return [
            'affiliation_id' => ['nullable', 'exists:institutions,id'],
            'name' => ['required', 'string'],
            'acronym' => ['required', 'max:10'],
            'type' => ['required', Rule::in([InstitutionType::UNIVERSITY,InstitutionType::UNIVERSITY_CAMPUS_COLLEGE,InstitutionType::UNIVERSITY_COLLEGE,InstitutionType::NON_UNIVERSITY])],
            'ownership' => ['required', Rule::in([InstitutionOwnership::PRIVATE_INSTITUTION,InstitutionOwnership::PUBLIC_INSTITUTION])],
            'code' => ['required', 'max:5'],
            'location' => ['required', 'string'],
            'admission_portal_link' => ['required', 'string'],
            'rank' => ['required', 'integer', 'min:1'],
        ];
    }

    public function messages()
    {
        return [
            'affiliation_id.exists' => 'The selected institution does not exist.',
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
            'rank.required' => 'Please insert the rank of the institution.',
            'rank.integer' => 'The rank of the institution should be in digits. (Eg. 4)',
            'rank.min' => 'The highest rank is represented by number one (1).',
        ];
    }

    private function accreditationExists($accreditations, $targetAccreditationStatus)
    {
        foreach($accreditations as $accreditation){
            if(isset($accreditation['status']) && $accreditation['status'] === $targetAccreditationStatus){
                return true;
            }
        }
        return false;
    }

    public function addAccreditationToSelection($accreditationID)
    {
        $accreditation = call_user_func_array('array_merge', array_filter($this->availableAccreditations->toArray(), function($accreditation) use ($accreditationID) { 
            return $accreditation['id'] === $accreditationID; 
        }));
        if ($this->accreditationExists($this->selectedAccreditations, $accreditation['status'])) {
            $this->dispatch("flash-alert", type: "info", title: "Info", message: "You've already selected the accreditation status!.");
            return;
        }
        $this->selectedAccreditations[] = $accreditation;
        $this->selectedOption = '';
    }

    public function removeAccreditationFromSelection($index)
    {
        unset($this->selectedAccreditations[$index]);
        $this->selectedAccreditations = array_values($this->selectedAccreditations);
    }
 
    public function updateInstitution()
    {
        $this->validate(); 
        if(count($this->selectedAccreditations) <= 0) return $this->dispatch("flash-alert", type: "error", title: "Error", message: "Please select atleast one accreditation status associated with the institution!.");
        try{
            DB::beginTransaction();
            $institutionRepo = new InstitutionRepository();
            $isUpdated = $institutionRepo->updateInstitution([
                'affiliation_id' => ($this->affiliation_id === "") ? null : $this->affiliation_id,
                'name' => $this->name,
                'acronym' => $this->acronym,
                'type' => $this->type,
                'ownership' => $this->ownership,
                'code' => $this->code,
                'location' => $this->location,
                'admission_portal_link' => $this->admission_portal_link,
                'rank' => $this->rank,
            ], $this->institutionId);

            if($isUpdated){
                $institutionRepo->linkToAccreditations($this->institutionId, array_pluck($this->selectedAccreditations, "id"));

                DB::commit();
                $this->dispatch("flash-alert", type: "success", title: "Success", message: "Institution is successfully updated!.");
            }else{
                DB::rollBack();
                $this->dispatch("flash-alert", type: "error", title: "Error", message: "Unable to update institution details! Try again later.");  
            }
        }catch(Exception $e){
            DB::rollBack();
            $this->dispatch("flash-alert", type: "error", title: "Error", message: $e->getMessage());
        }      
    }

    public function render()
    {
        $this->allMotherInstitutions = (new InstitutionRepository)->allMotherInstitutionsExceptWithoutPagination($this->institutionId);
        $this->availableAccreditations = (new AccreditationRepository())->allAccreditationsWithoutPagination();
        return view('livewire.institutions.edit');
    }
}
