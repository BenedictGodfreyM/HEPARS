<?php

namespace App\Livewire\Users;

use App\Repositories\UserRepository;
use Livewire\Component;

class View extends Component
{
    public $user_id = "";
    public $data;

    public function mount($user_id)
    {
        $this->user_id = $user_id;
        $this->loadData();
    }

    public function loadData()
    {
        $this->data = (new UserRepository())->findUser($this->user_id); 
    }

    public function render()
    {
        return view('livewire.users.view');
    }
}
