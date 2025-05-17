<?php

namespace App\Livewire\Accreditation;

use App\Repositories\AccreditationRepository;
use Livewire\Component;

class View extends Component
{
    public $accreditation_id = "";
    public $data;

    public function mount($accreditation_id)
    {
        $this->accreditation_id = $accreditation_id;
        $this->loadData();
    }

    public function loadData()
    {
        $this->data = (new AccreditationRepository())->findAccreditation($this->accreditation_id); 
    }

    public function render()
    {
        return view('livewire.accreditation.view');
    }
}
