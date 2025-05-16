<?php

namespace App\Livewire\Institutions;

use App\Repositories\InstitutionRepository;
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
    public $columns = ['name','acronym','type','ownership','code','location'];
    
    // For Toggling Modals
    public $showEditorModel = false;
    public $selectedRecord_InstitutionID;

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

    public function openEditorModal($record_InstitutionID)
    {
        $this->selectedRecord_InstitutionID = $record_InstitutionID;
        $this->showEditorModel = true;
    }

    public function closeEditorModel()
    {
        $this->showEditorModel = false;
    }

    public function delete($id)
    {
        try{
            DB::beginTransaction();
            (new InstitutionRepository())->destroyInstitution($id);
            $this->render();
            DB::commit();
            $this->dispatch("flash-alert", type: "success", title: "Success", message: "Institution is successfully deleted.!");
        }catch(Exception $e){
            DB::rollBack();
            $this->dispatch("flash-alert", type: "error", title: "Error", message: $e->getMessage());
        }  
    }

    public function render()
    {
        $data = (new InstitutionRepository())->allInstitutions($this->searchQuery, $this->sortField, $this->sortDirection, $this->pageSize);
        return view('livewire.institutions.datatable', [
            'data' => $data,
            'columns' => $this->columns,
        ]);
    }
}
