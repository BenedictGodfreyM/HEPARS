<?php

namespace App\Livewire\Roles;

use App\Repositories\RoleRepository;
use Livewire\Component;

class View extends Component
{
    public $role_id = "";
    public $data;

    public function mount($role_id)
    {
        $this->role_id = $role_id;
        $this->loadData();
    }

    public function loadData()
    {
        $this->data = (new RoleRepository())->findRole($this->role_id); 
    }

    public function render()
    {
        return view('livewire.roles.view');
    }
}
