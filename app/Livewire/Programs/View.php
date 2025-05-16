<?php

namespace App\Livewire\Programs;

use App\Repositories\ProgramRepository;
use Livewire\Component;

class View extends Component
{
    public $institutionId = "";
    public $programId = "";
    public $data;

    public function mount($institution_id, $program_id)
    {
        $this->institutionId = $institution_id;
        $this->programId = $program_id;
        $this->loadData();
    }

    public function loadData()
    {
        $this->data = (new ProgramRepository())->findProgram($this->programId); 
    }

    public function render()
    {
        return view('livewire.programs.view');
    }
}
