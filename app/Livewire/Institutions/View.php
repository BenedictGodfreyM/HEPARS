<?php

namespace App\Livewire\Institutions;

use App\Repositories\InstitutionRepository;
use Livewire\Component;

class View extends Component
{
    public $institutionId = "";
    public $data;

    public function mount($institution_id)
    {
        $this->institutionId = $institution_id;
        $this->loadData();
    }

    public function loadData()
    {
        $this->data = (new InstitutionRepository())->findInstitution($this->institutionId); 
    } 
    
    public function render()
    {
        return view('livewire.institutions.view');
    }
}
