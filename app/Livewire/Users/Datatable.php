<?php

namespace App\Livewire\Users;

use App\Repositories\UserRepository;
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
    public $columns = ['firstname','surname','email'];
    
    // For Toggling Modals
    public $showDetailsModel = false;
    public $showEditorModel = false;
    public $selectedRecord_UserID;

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

    public function openDetailsModal($UserID)
    {
        $this->selectedRecord_UserID = $UserID;
        $this->showDetailsModel = true;
    }

    public function closeDetailsModel()
    {
        $this->showDetailsModel = false;
    }

    public function openEditorModal($UserID)
    {
        $this->selectedRecord_UserID = $UserID;
        $this->showEditorModel = true;
    }

    public function closeEditorModel()
    {
        $this->showEditorModel = false;
    }

    public function delete($user_id)
    {
        try{
            (new UserRepository())->destroyUser($user_id);
            $this->render();
            DB::commit();
            $this->dispatch("flash-alert", type: "success", title: "Success", message: "User is successfully deleted.!");
        }catch(Exception $e){
            DB::rollBack();
            $this->dispatch("flash-alert", type: "error", title: "Error", message: $e->getMessage());
        }  
    }

    public function render()
    {
        $data = (new UserRepository())->allUsers($this->searchQuery, $this->sortField, $this->sortDirection, $this->pageSize);
        return view('livewire.users.datatable', [
            'data' => $data,
            'columns' => $this->columns,
        ]);
    }
}
