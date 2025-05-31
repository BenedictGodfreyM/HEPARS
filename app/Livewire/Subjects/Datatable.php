<?php

namespace App\Livewire\Subjects;

use App\Repositories\SubjectRepository;
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
    public $columns = ['name','code','compulsory','additional'];
    
    // For Toggling Modals
    public $showCreatorModel = false;
    public $showEditorModel = false;
    public $selectedRecord_SubjectID;

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

    public function openCreatorModal()
    {
        $this->showCreatorModel = true;
    }

    public function closeCreatorModel()
    {
        $this->showCreatorModel = false;
    }

    public function openEditorModal($SubjectID)
    {
        $this->selectedRecord_SubjectID = $SubjectID;
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
            (new SubjectRepository())->destroySubject($id);
            $this->render();
            DB::commit();
            $this->dispatch("flash-alert", type: "success", title: "Success", message: "Subject is successfully deleted.!");
        }catch(Exception $e){
            DB::rollBack();
            $this->dispatch("flash-alert", type: "error", title: "Error", message: $e->getMessage());
        }  
    }

    public function render()
    {
        $data = (new SubjectRepository())->allSubjects($this->searchQuery, $this->sortField, $this->sortDirection, $this->pageSize);
        return view('livewire.subjects.datatable', [
            'data' => $data,
            'columns' => $this->columns,
        ]);
    }
}
