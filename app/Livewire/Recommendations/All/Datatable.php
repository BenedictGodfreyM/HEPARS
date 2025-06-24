<?php

namespace App\Livewire\Recommendations\All;

use App\Repositories\RecommendationRepository;
use DateTime;
use Exception;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class Datatable extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';
    public $pageSize = 10;
    
    // For Toggling Modals
    public $showDetailsModel = false;
    public $selectedRecord_RecommendationID;
    public $selectedRecord_RecommendationDate;

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function openEditorModal($RecommendationID, $RecommendationDate)
    {
        $this->selectedRecord_RecommendationID = $RecommendationID;
        $this->selectedRecord_RecommendationDate = (new DateTime($RecommendationDate))->format("M d, Y H:i A");
        $this->showDetailsModel = true;
    }

    public function closeEditorModel()
    {
        $this->showDetailsModel = false;
    }

    public function delete($id)
    {
        try{
            (new RecommendationRepository())->destroyRecommendation($id);
            $this->render();
            DB::commit();
            $this->dispatch("flash-alert", type: "success", title: "Success", message: "Recommendation is successfully deleted.!");
        }catch(Exception $e){
            DB::rollBack();
            $this->dispatch("flash-alert", type: "error", title: "Error", message: $e->getMessage());
        }  
    }

    public function render()
    {
        $data = (new RecommendationRepository())->allRecommendations($this->pageSize);
        return view('livewire.recommendations.all.datatable', [
            'data' => $data,
        ]);
    }
}
