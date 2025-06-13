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

    function arrayToSentence(array $items, $separator = ', ', $lastSeparator = ' and ') {
        if (empty($items)) {
            return '';
        }
        if (count($items) === 1) {
            return $items[0];
        }
        $lastItem = array_pop($items);
        return implode($separator, $items) . $lastSeparator . $lastItem;
    }

    public function render()
    {
        return view('livewire.users.view');
    }
}
