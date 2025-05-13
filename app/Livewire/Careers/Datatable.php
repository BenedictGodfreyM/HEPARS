<?php

namespace App\Livewire\Careers;

use App\Repositories\CareerRepository;
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

    public $discipline_id;

    public function mount($discipline_id)
    {
        $this->discipline_id = $discipline_id;
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

    public function delete($id)
    {
        $repository = new CareerRepository();
        try{
            DB::beginTransaction();
            $repository->destroyCareer($id);
            $this->render();
            DB::commit();
            session()->flash('success','Career is successfully deleted.');
        }catch(Exception $e){
            DB::rollBack();
            session()->flash('error',$e->getMessage());
        }  
    }

    public function render()
    {
        $repository = new CareerRepository();
        $data = $repository->careersFromDiscipline($this->discipline_id, $this->searchQuery, $this->sortField, $this->sortDirection, $this->pageSize);

        return view('livewire.careers.datatable', [
            'discipline_id' => $this->discipline_id,
            'data' => $data,
            'columns' => $this->columns,
        ]);
    }
}
