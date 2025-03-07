<?php

namespace App\Livewire\Shared;

use Livewire\Component;

class Alert extends Component
{
    public $alert_title;
    public $alert_message;
    public $alert_css_style;
    public $alert_icon;

    public function mount($title = "", $message = "", $css_class = "alert-info", $icon = "fa-info")
    {
        $this->alert_title = $title;
        $this->alert_message = $message;
        $this->alert_css_style = $css_class;
        $this->alert_icon = $icon;
    }

    public function render()
    {
        return view('livewire.shared.alert');
    }
}
