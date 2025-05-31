<?php

namespace App\Livewire\Careers;

use App\Repositories\CareerRepository;
use App\Repositories\FieldRepository;
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
    public $showCreatorModel = false;
    public $showEditorModel = false;
    public $selectedRecord_FieldID;
    public $selectedRecord_CareerID;

    public $field_id;
    public $field;

    public function mount($field_id)
    {
        $this->field_id = $field_id;
        $this->field = (new FieldRepository)->findField($field_id);
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

    public function openCreatorModal($FieldID)
    {
        $this->selectedRecord_FieldID = $FieldID;
        $this->showCreatorModel = true;
    }

    public function closeCreatorModel()
    {
        $this->showCreatorModel = false;
    }

    public function openEditorModal($FieldID, $CareerID)
    {
        $this->selectedRecord_FieldID = $FieldID;
        $this->selectedRecord_CareerID = $CareerID;
        $this->showEditorModel = true;
    }

    public function closeEditorModel()
    {
        $this->showEditorModel = false;
    }

    public function delete($id)
    {
        $repository = new CareerRepository();
        try{
            (new CareerRepository())->destroyCareer($id);
            $this->render();
            DB::commit();
            $this->dispatch("flash-alert", type: "success", title: "Success", message: "Career is successfully deleted.!");
        }catch(Exception $e){
            DB::rollBack();
            $this->dispatch("flash-alert", type: "error", title: "Error", message: $e->getMessage());
        }  
    }

    public function render()
    {
        $data = (new CareerRepository())->careersFromField($this->field_id, $this->searchQuery, $this->sortField, $this->sortDirection, $this->pageSize);
        return view('livewire.careers.datatable', [
            'field_id' => $this->field_id,
            'data' => $data,
            'columns' => $this->columns,
        ]);
    }
}
