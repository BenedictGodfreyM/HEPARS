<?php

namespace App\Repositories;

use App\Models\Combination;

class CombinationRepository
{
    /**
     * Get the total number of combinations in the database
     * 
     * @return integer
     */
    public function totalCombinations()
    {
        return Combination::count();
    }

    /**
     * Retrieve all combinations from the database
     * 
     * @return Illuminate\Pagination\LengthAwarePaginator
     */
    public function allCombinations($search, $sortField = "name", $sortDirection = "desc", $perPage = 10)
    {
        return Combination::where('name', 'like', '%' . $search . '%')
                        ->orderBy($sortField, $sortDirection)
                        ->paginate($perPage);
    }

    /**
     * Retrieve all combinations from the database (Without Pagination)
     * 
     * @return Illuminate\Database\Eloquent\Collection
     */
    public function allCombinationsWithoutPagination()
    {
        return Combination::query()->orderBy('name','asc')->get();
    }

    /**
     * Save details of a combination to the database
     * 
     * @param array $data Details of a particular combination
     * 
     * @return Illuminate\Database\Eloquent\Model
     */
    public function storeCombination(array $data)
    {
        return Combination::create([
            'name' => $data['name']
        ]);
    }

    /**
     * Retrieve a combination by its ID from the database
     * 
     * @param string $id combination ID
     * 
     * @return Illuminate\Database\Eloquent\Model
     */
    public function findCombination($id)
    {
        return Combination::findOrFail($id);
    }

    /**
     * Update details of a combination
     * 
     * @param array $data Details of a particular combination
     * @param string $id combination ID
     * 
     * @return boolean
     */
    public function updateCombination(array $data, string $id)
    {
        $combination = Combination::where('id', $id)->firstOrFail();
        $combination->name = $data['name'];
        return $combination->save();
    }

    /**
     * Link a particular combination to a specific subject
     * 
     * @param string $combination_id
     * @param string $subject_id
     * 
     * @return void
     */
    public function linkToSubject(string $combination_id, string $subject_id)
    {
        $combination = Combination::findOrFail($combination_id);
        $combination->subjects()->attach($subject_id);
    }

    /**
     * Synchronize a particular combination to multiple subjects
     * 
     * @param string $combination_id
     * @param array $subjects Array of IDs of specific subjects
     * 
     * @return void
     */
    public function linkToSubjects(string $combination_id, array $subjects)
    {
        $combination = Combination::findOrFail($combination_id);
        $combination->subjects()->sync($subjects);
    }

    /**
     * Permanently, delete a combination from the database
     * 
     * @param string $id combination ID
     * 
     * @return integer Number of records deleted (0 for none)
     */
    public function destroyCombination($id)
    {
        $combination = Combination::findOrFail($id);
        return $combination->delete();
    }
}