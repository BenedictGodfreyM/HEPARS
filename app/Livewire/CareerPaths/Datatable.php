<?php

namespace App\Livewire\CareerPaths;

use App\Repositories\CareerPathRepository;
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
        $repository = new CareerPathRepository();
        try{
            DB::beginTransaction();
            $repository->destroyCareerPath($id);
            $this->render();
            DB::commit();
            session()->flash('success','Career Path is successfully deleted.');
        }catch(Exception $e){
            DB::rollBack();
            session()->flash('error',$e->getMessage());
        }  
    }

    public function render()
    {
        $repository = new CareerPathRepository();
        $data = $repository->allCareerPaths($this->searchQuery, $this->sortField, $this->sortDirection, $this->pageSize);

        return view('livewire.career-paths.datatable', [
            'data' => $data,
            'columns' => $this->columns,
        ]);
    }
}
