<?php

namespace App\Livewire\Accreditation;

use App\Repositories\AccreditationRepository;
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
    public $columns = ['status','rating'];
    
    // For Toggling Modals
    public $showDetailsModel = false;
    public $showEditorModel = false;
    public $selectedRecord_AccreditationID;

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

    public function openDetailsModal($AccreditationID)
    {
        $this->selectedRecord_AccreditationID = $AccreditationID;
        $this->showDetailsModel = true;
    }

    public function closeDetailsModel()
    {
        $this->showDetailsModel = false;
    }

    public function openEditorModal($AccreditationID)
    {
        $this->selectedRecord_AccreditationID = $AccreditationID;
        $this->showEditorModel = true;
    }

    public function closeEditorModel()
    {
        $this->showEditorModel = false;
    }

    public function delete($accreditation_id)
    {
        try{
            (new AccreditationRepository())->destroyAccreditation($accreditation_id);
            $this->render();
            DB::commit();
            $this->dispatch("flash-alert", type: "success", title: "Success", message: "Accreditation Status is successfully deleted.!");
        }catch(Exception $e){
            DB::rollBack();
            $this->dispatch("flash-alert", type: "error", title: "Error", message: $e->getMessage());
        }  
    }

    public function render()
    {
        $data = (new AccreditationRepository())->allAccreditations($this->searchQuery, $this->sortField, $this->sortDirection, $this->pageSize);
        return view('livewire.accreditation.datatable', [
            'data' => $data,
            'columns' => $this->columns,
        ]);
    }
}
