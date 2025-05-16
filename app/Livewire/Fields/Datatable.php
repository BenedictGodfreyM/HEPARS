<?php

namespace App\Livewire\Fields;

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
    public $showEditorModel = false;
    public $selectedRecord_FieldID;

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

    public function openEditorModal($FieldID)
    {
        $this->selectedRecord_FieldID = $FieldID;
        $this->showEditorModel = true;
    }

    public function closeEditorModel()
    {
        $this->showEditorModel = false;
    }

    public function delete($field_id)
    {
        $fieldRepo = new FieldRepository();
        try{
            (new FieldRepository())->destroyField($field_id);
            $this->render();
            DB::commit();
            $this->dispatch("flash-alert", type: "success", title: "Success", message: "Field is successfully deleted.!");
        }catch(Exception $e){
            DB::rollBack();
            $this->dispatch("flash-alert", type: "error", title: "Error", message: $e->getMessage());
        }  
    }

    public function render()
    {
        $data = (new FieldRepository())->allFields($this->searchQuery, $this->sortField, $this->sortDirection, $this->pageSize);
        return view('livewire.fields.datatable', [
            'data' => $data,
            'columns' => $this->columns,
        ]);
    }
}
