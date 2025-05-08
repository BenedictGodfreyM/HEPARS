<?php

namespace App\Livewire;

use App\Repositories\InstitutionRepository;
use Livewire\Component;
use Livewire\WithPagination;

class AdmissionPortals extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $searchQuery = '';
    public $sortField = 'id';
    public $sortDirection = 'asc';
    public $pageSize = 10;
    
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
        $repository = new InstitutionRepository();
        $data = $repository->allInstitutions($this->searchQuery, $this->sortField, $this->sortDirection, $this->pageSize);

        return view('livewire.admission-portals', [
            'data' => $data,
        ]);
    }
}
