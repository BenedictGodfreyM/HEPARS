<?php

namespace App\Livewire\Recommendations;

use App\Repositories\RecommendationRepository;
use Livewire\Component;

class View extends Component
{
    public $recommendationId = "";
    public $data;

    public function mount($recommendation_id)
    {
        $this->recommendationId = $recommendation_id;
        $this->loadData();
    }

    public function loadData()
    {
        $this->data = (new RecommendationRepository())->findRecommendation($this->recommendationId); 
    }

    public function render()
    {
        return view('livewire.recommendations.view');
    }
}
