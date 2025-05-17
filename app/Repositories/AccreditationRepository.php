<?php

namespace App\Repositories;

use App\Models\Accreditation;

class AccreditationRepository
{
    /**
     * Get the total number of accreditations in the database
     * 
     * @return integer
     */
    public function totalAccreditations()
    {
        return Accreditation::count();
    }

    /**
     * Retrieve all accreditations from the database
     * 
     * @return Illuminate\Pagination\LengthAwarePaginator
     */
    public function allAccreditations($search, $sortField = "name", $sortDirection = "desc", $perPage = 10)
    {
        return Accreditation::where('status', 'like', '%' . $search . '%')
                        ->orWhere('rating', 'like', '%' . $search . '%')
                        ->orderBy($sortField, $sortDirection)
                        ->paginate($perPage);
    }

    /**
     * Retrieve all accreditations from the database (Without Pagination)
     * 
     * @return Illuminate\Database\Eloquent\Collection
     */
    public function allAccreditationsWithoutPagination()
    {
        return Accreditation::query()->orderBy('status','asc')->get();
    }

    /**
     * Save details of a accreditation to the database
     * 
     * @param array $data Details of a particular accreditation
     * 
     * @return Illuminate\Database\Eloquent\Model
     */
    public function storeAccreditation(array $data)
    {
        return Accreditation::create([
            'status' => $data['status'],
            'rating' => $data['rating'],
            'description' => $data['description'],
        ]);
    }

    /**
     * Retrieve a accreditation by its ID from the database
     * 
     * @param string $id accreditation ID
     * 
     * @return Illuminate\Database\Eloquent\Model
     */
    public function findAccreditation($id)
    {
        return Accreditation::findOrFail($id);
    }

    /**
     * Update details of a accreditation
     * 
     * @param array $data Details of a particular accreditation
     * @param string $id accreditation ID
     * 
     * @return boolean
     */
    public function updateAccreditation(array $data, string $id)
    {
        $accreditation = Accreditation::where('id', $id)->firstOrFail();
        $accreditation->status = $data['status'];
        $accreditation->rating = $data['rating'];
        $accreditation->description = $data['description'];
        return $accreditation->save();
    }

    /**
     * Permanently, delete a accreditation from the database
     * 
     * @param string $id accreditation ID
     * 
     * @return integer Number of records deleted (0 for none)
     */
    public function destroyAccreditation($id)
    {
        $accreditation = Accreditation::findOrFail($id);
        return $accreditation->delete();
    }
}