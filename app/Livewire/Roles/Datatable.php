<?php

namespace App\Livewire\Roles;

use App\Repositories\RoleRepository;
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
    public $columns = ['name','slug','level'];
    
    // For Toggling Modals
    public $showDetailsModel = false;
    public $showCreatorModel = false;
    public $showEditorModel = false;
    public $selectedRecord_RoleID;

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

    public function openDetailsModal($RoleID)
    {
        $this->selectedRecord_RoleID = $RoleID;
        $this->showDetailsModel = true;
    }

    public function closeDetailsModel()
    {
        $this->showDetailsModel = false;
    }

    public function openCreatorModal()
    {
        $this->showCreatorModel = true;
    }

    public function closeCreatorModel()
    {
        $this->showCreatorModel = false;
    }

    public function openEditorModal($RoleID)
    {
        $this->selectedRecord_RoleID = $RoleID;
        $this->showEditorModel = true;
    }

    public function closeEditorModel()
    {
        $this->showEditorModel = false;
    }

    public function delete($role_id)
    {
        try{
            (new RoleRepository())->destroyRole($role_id);
            $this->render();
            DB::commit();
            $this->dispatch("flash-alert", type: "success", title: "Success", message: "Role is successfully deleted.!");
        }catch(Exception $e){
            DB::rollBack();
            $this->dispatch("flash-alert", type: "error", title: "Error", message: $e->getMessage());
        }  
    }

    public function render()
    {
        $data = (new RoleRepository())->allRoles($this->searchQuery, $this->sortField, $this->sortDirection, $this->pageSize);
        return view('livewire.roles.datatable', [
            'data' => $data,
            'columns' => $this->columns,
        ]);
    }
}
