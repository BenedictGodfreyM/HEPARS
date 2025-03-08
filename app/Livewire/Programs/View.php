<?php

namespace App\Livewire\Programs;

use App\Repositories\ProgramRepository;
use Livewire\Component;

class View extends Component
{
    public $institutionId = "";
    public $programId = "";

    public function mount($institution_id, $program_id)
    {
        $this->institutionId = $institution_id;
        $this->programId = $program_id;
    }

    public function render()
    {
        $repository = new ProgramRepository();
        $data = $repository->findProgram($this->programId);
        return view('livewire.programs.view', [
            'institutionID' => $this->institutionId,
            'programID' => $this->programId,
            'data' => $data,
        ]);
    }
}
