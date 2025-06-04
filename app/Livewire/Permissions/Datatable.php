<?php

namespace App\Livewire\Permissions;

use App\Repositories\PermissionRepository;
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
    public $columns = ['name','slug','model','description'];

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

    public function render()
    {
        $data = (new PermissionRepository())->allPermissions($this->searchQuery, $this->sortField, $this->sortDirection, $this->pageSize);
        return view('livewire.permissions.datatable', [
            'data' => $data,
            'columns' => $this->columns,
        ]);
    }
}
