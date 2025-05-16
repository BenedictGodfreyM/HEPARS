<?php

namespace App\Livewire\Combinations;

use App\Repositories\CombinationRepository;
use Exception;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class Datatable extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $searchQuery = '';
    public $sortField = 'id';
    public $sortDirection = 'asc';
    public $pageSize = 10;
    public $columns = ['name'];

    // For Toggling Modals
    public $showEditorModel = false;
    public $selectedRecord_CombinationID;

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function sortBy($field)
    {
        if ($this->sortField === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortDirection = 'asc';
        }

        $this->sortField = $field;
    }

    public function openEditorModal($record_CombinationID)
    {
        $this->selectedRecord_CombinationID = $record_CombinationID;
        $this->showEditorModel = true;
    }

    public function closeEditorModel()
    {
        $this->showEditorModel = false;
    }

    public function delete($combination_id)
    {
        try{
            DB::beginTransaction();
            (new CombinationRepository())->destroyCombination($combination_id);
            $this->render();
            DB::commit();
            $this->dispatch("flash-alert", type: "success", title: "Success", message: "Combination is successfully deleted.!");
        }catch(Exception $e){
            DB::rollBack();
            $this->dispatch("flash-alert", type: "error", title: "Error", message: $e->getMessage());
        }  
    }

    public function render()
    {
        $data = (new CombinationRepository())->allCombinations($this->searchQuery, $this->sortField, $this->sortDirection, $this->pageSize);
        return view('livewire.combinations.datatable', [
            'data' => $data,
            'columns' => $this->columns,
        ]);
    }
}
