<?php

namespace App\Repositories;

use App\Models\CareerPath;

class CareerPathRepository
{
    /**
     * Get the total number of career paths in the database
     * 
     * @return integer
     */
    public function totalCareerPaths()
    {
        return CareerPath::count();
    }

    /**
     * Retrieve all career paths from the database
     * 
     * @return Illuminate\Pagination\LengthAwarePaginator
     */
    public function allCareerPaths($search, $sortField = "name", $sortDirection = "desc", $perPage = 10)
    {
        return CareerPath::where('name', 'like', '%' . $search . '%')
                            ->orderBy($sortField, $sortDirection)
                            ->paginate($perPage);
    }

    /**
     * Save details of a career path to the database
     * 
     * @param array $data Details of a particular career path
     * 
     * @return Illuminate\Database\Eloquent\Model
     */
    public function storeCareerPath(array $data)
    {
        return CareerPath::create([
            'name' => $data['name'],
        ]);
    }

    /**
     * Retrieve a career path by its ID from the database
     * 
     * @param string $id career path ID
     * 
     * @return Illuminate\Database\Eloquent\Model
     */
    public function findCareerPath($id)
    {
        return CareerPath::findOrFail($id);
    }

    /**
     * Update details of a career path
     * 
     * @param array $data Details of a particular career path
     * @param string $id career_path ID
     * 
     * @return boolean
     */
    public function updateCareerPath(array $data, string $id)
    {
        $career_path = CareerPath::where('id', $id)->firstOrFail();
        $career_path->name = $data['name'];
        return $career_path->save();
    }

    /**
     * Permanently, delete a career path from the database
     * 
     * @param string $id career path ID
     * 
     * @return integer Number of records deleted (0 for none)
     */
    public function destroyCareerPath($id)
    {
        $career_path = CareerPath::findOrFail($id);
        return $career_path->delete();
    }
}