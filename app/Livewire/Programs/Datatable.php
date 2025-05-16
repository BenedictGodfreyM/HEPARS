<?php

namespace App\Livewire\Programs;

use App\Repositories\ProgramRepository;
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
    public $columns = ['name','duration'];

    public $institutionId;

    // For Toggling Modals
    public $showDetailsModel = false;
    public $showEditorModel = false;
    public $selectedRecord_ProgramID;
    public $selectedRecord_InstitutionID;

    public function mount($institution_id)
    {
        $this->institutionId = $institution_id;
    }

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

    public function openDetailsModal($record_InstitutionID, $record_ProgramID)
    {
        $this->selectedRecord_InstitutionID = $record_InstitutionID;
        $this->selectedRecord_ProgramID = $record_ProgramID;
        $this->showDetailsModel = true;
    }

    public function closeDetailsModel()
    {
        $this->showDetailsModel = false;
    }

    public function openEditorModal($record_InstitutionID, $record_ProgramID)
    {
        $this->selectedRecord_InstitutionID = $record_InstitutionID;
        $this->selectedRecord_ProgramID = $record_ProgramID;
        $this->showEditorModel = true;
    }

    public function closeEditorModel()
    {
        $this->showEditorModel = false;
    }

    public function delete($program_id)
    {
        try{
            DB::beginTransaction();
            (new ProgramRepository())->destroyProgram($program_id);
            $this->render();
            DB::commit();
            $this->dispatch("flash-alert", type: "success", title: "Success", message: "Program is successfully deleted.!");
        }catch(Exception $e){
            DB::rollBack();
            $this->dispatch("flash-alert", type: "error", title: "Error", message: $e->getMessage());
        }  
    }

    public function render()
    {
        $data = (new ProgramRepository())->institutionPrograms($this->institutionId, $this->searchQuery, $this->sortField, $this->sortDirection, $this->pageSize);
        return view('livewire.programs.datatable', [
            'institutionId' => $this->institutionId,
            'data' => $data,
            'columns' => $this->columns,
        ]);
    }
}
