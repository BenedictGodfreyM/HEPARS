<?php

namespace App\Livewire\Shared;

use Livewire\Component;

class BarChart extends Component
{
    public $chartId;
    public $chartLabels;
    public $chartData;
    public $description;

    public function mount($description = "", $chartLabels = [], $chartData = [])
    {
        $this->chartId = 'barChart-' . uniqid();
        $this->chartLabels = $chartLabels;
        $this->chartData = $chartData;
        $this->description = $description;
    }

    public function render()
    {
        return view('livewire.shared.bar-chart');
    }
}
