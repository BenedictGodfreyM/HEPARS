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

    public function delete($id)
    {
        $repository = new InstitutionRepository();
        try{
            DB::beginTransaction();
            $repository->destroyInstitution($id);
            $this->render();
            DB::commit();
            session()->flash('success','Institution is successfully deleted.');
        }catch(Exception $e){
            DB::rollBack();
            session()->flash('error',$e->getMessage());
        }  
    }

    public function render()
    {
        $repository = new InstitutionRepository();
        $data = $repository->allInstitutions($this->searchQuery, $this->sortField, $this->sortDirection, $this->pageSize);

        return view('livewire.institutions.datatable', [
            'data' => $data,
            'columns' => $this->columns,
        ]);
    }
}
