<?php

namespace App\Repositories;

use App\Models\Discipline;

class DisciplineRepository
{
    /**
     * Get the total number of disciplines in the database
     * 
     * @return integer
     */
    public function totalDisciplines()
    {
        return Discipline::count();
    }

    /**
     * Retrieve all disciplines from the database
     * 
     * @return Illuminate\Pagination\LengthAwarePaginator
     */
    public function allDisciplines($search, $sortField = "name", $sortDirection = "desc", $perPage = 10)
    {
        return Discipline::where('name', 'like', '%' . $search . '%')
                            ->orderBy($sortField, $sortDirection)
                            ->paginate($perPage);
    }

    /**
     * Retrieve all disciplines from the database (Without Pagination, Sorting and Search Features)
     * 
     * @return Illuminate\Database\Eloquent\Collection
     */
    public function allDisciplinesWithoutPagination()
    {
        return Discipline::query()->orderBy('name','asc')->get();
    }

    /**
     * Save details of a discipline to the database
     * 
     * @param array $data Details of a particular discipline
     * 
     * @return Illuminate\Database\Eloquent\Model
     */
    public function storeDiscipline(array $data)
    {
        return Discipline::create([
            'name' => $data['name'],
        ]);
    }

    /**
     * Retrieve a discipline by its ID from the database
     * 
     * @param string $id discipline ID
     * 
     * @return Illuminate\Database\Eloquent\Model
     */
    public function findDiscipline($id)
    {
        return Discipline::findOrFail($id);
    }

    /**
     * Update details of a discipline
     * 
     * @param array $data Details of a particular discipline
     * @param string $id discipline ID
     * 
     * @return boolean
     */
    public function updateDiscipline(array $data, string $id)
    {
        $discipline = Discipline::where('id', $id)->firstOrFail();
        $discipline->name = $data['name'];
        return $discipline->save();
    }

    /**
     * Permanently, delete a discipline from the database
     * 
     * @param string $id discipline ID
     * 
     * @return integer Number of records deleted (0 for none)
     */
    public function destroyDiscipline($id)
    {
        $discipline = Discipline::findOrFail($id);
        return $discipline->delete();
    }

    /**
     * Add careers to a discipline
     * 
     * @param array $data Details of a particular career
     * @param string $discipline_id discipline ID
     * 
     * @return Illuminate\Database\Eloquent\Model
     */
    public function addCareer(array $data, string $discipline_id)
    {
        $discipline = Discipline::findOrFail($discipline_id);
        return $discipline->careers()->create([
            'name' => $data['name'],
        ]);
    }
}