<?php

namespace App\Livewire\Programs;

use App\Repositories\ProgramRepository;
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
    public $columns = ['name','duration'];

    public $institutionId;

    public function mount($institution_id)
    {
        $this->institutionId = $institution_id;
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

    public function delete($program_id)
    {
        $programRepo = new ProgramRepository();
        try{
            DB::beginTransaction();
            $programRepo->destroyProgram($program_id);
            $this->render();
            DB::commit();
            session()->flash('success','Program is successfully deleted.');
        }catch(Exception $e){
            DB::rollBack();
            session()->flash('error',$e->getMessage());
        }  
    }

    public function render()
    {
        $repository = new ProgramRepository();
        $data = $repository->institutionPrograms($this->institutionId, $this->searchQuery, $this->sortField, $this->sortDirection, $this->pageSize);
        return view('livewire.programs.datatable', [
            'institutionId' => $this->institutionId,
            'data' => $data,
            'columns' => $this->columns,
        ]);
    }
}
