<?php

namespace App\Repositories;

use App\Models\Career;
use Illuminate\Database\Eloquent\Builder;

class CareerRepository
{
    /**
     * Get the total number of careers in the database
     * 
     * @return integer
     */
    public function totalCareers()
    {
        return Career::count();
    }

    /**
     * Retrieve all careers from the database
     * 
     * @return Illuminate\Pagination\LengthAwarePaginator
     */
    public function allCareers($search, $sortField = "name", $sortDirection = "desc", $perPage = 10)
    {
        return Career::where('name', 'like', '%' . $search . '%')
                            ->orderBy($sortField, $sortDirection)
                            ->paginate($perPage);
    }

    /**
     * Retrieve all careers from the database (Without Pagination, Sorting and Search Features)
     * 
     * @return Illuminate\Database\Eloquent\Collection
     */
    public function allCareersWithoutPagination()
    {
        return Career::query()->orderBy('name','asc')->get();
    }

    /**
     * Retrieve all careers from a certain discipline
     * 
     * @return Illuminate\Pagination\LengthAwarePaginator
     */
    public function careersFromDiscipline($discipline_id, $search, $sortField = "name", $sortDirection = "desc", $perPage = 10)
    {
        return Career::where('discipline_id', '=', $discipline_id)
                        ->where(function(Builder $query) use($search){
                            $query->where('name', 'like', '%' . $search . '%');
                        })
                        ->orderBy($sortField, $sortDirection)
                        ->paginate($perPage);
    }

    /**
     * Retrieve a career by its ID from the database
     * 
     * @param string $id career ID
     * 
     * @return Illuminate\Database\Eloquent\Model
     */
    public function findCareer($id)
    {
        return Career::findOrFail($id);
    }

    /**
     * Update details of a career
     * 
     * @param array $data Details of a particular career
     * @param string $id career ID
     * 
     * @return boolean
     */
    public function updateCareer(array $data, string $id)
    {
        $career = Career::where('id', $id)->firstOrFail();
        $career->discipline_id = $data['discipline_id'];
        $career->name = $data['name'];
        return $career->save();
    }

    /**
     * Permanently, delete a career path from the database
     * 
     * @param string $id career path ID
     * 
     * @return integer Number of records deleted (0 for none)
     */
    public function destroyCareer($id)
    {
        $career = Career::findOrFail($id);
        return $career->delete();
    }
}