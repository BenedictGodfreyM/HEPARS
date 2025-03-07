<?php

namespace App\Livewire\Shared;

use Livewire\Component;

class StatBox extends Component
{
    public $stat_count;
    public $stat_label;
    public $stat_referral_route;
    public $stat_box_css_class;
    public $stat_box_icon;

    public function mount($count = 0, $label = "", $referral_route = "dashboard", $css_class = "bg-info", $icon = "ion-bag")
    {
        $this->stat_count = $count;
        $this->stat_label = $label;
        $this->stat_referral_route = $referral_route;
        $this->stat_box_css_class = $css_class;
        $this->stat_box_icon = $icon;
    }

    public function render()
    {
        return view('livewire.shared.stat-box');
    }
}
