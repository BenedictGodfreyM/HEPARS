<?php

namespace App\Livewire\Disciplines;

use App\Repositories\DisciplineRepository;
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

    public function delete($discipline_id)
    {
        $disciplineRepo = new DisciplineRepository();
        try{
            DB::beginTransaction();
            $disciplineRepo->destroyDiscipline($discipline_id);
            $this->render();
            DB::commit();
            session()->flash('success','Discipline is successfully deleted.');
        }catch(Exception $e){
            DB::rollBack();
            session()->flash('error',$e->getMessage());
        }  
    }

    public function render()
    {
        $repository = new DisciplineRepository();
        $data = $repository->allDisciplines($this->searchQuery, $this->sortField, $this->sortDirection, $this->pageSize);
        return view('livewire.disciplines.datatable', [
            'data' => $data,
            'columns' => $this->columns,
        ]);
    }
}
