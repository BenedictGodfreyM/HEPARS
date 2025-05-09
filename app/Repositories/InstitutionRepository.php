<?php

namespace App\Repositories;

use App\Models\Institution;

class InstitutionRepository
{
    /**
     * Get the total number of institutions in the database
     * 
     * @return integer
     */
    public function totalInstitutions()
    {
        return Institution::count();
    }

    /**
     * Retrieve all institutions from the database
     * 
     * @return Illuminate\Pagination\LengthAwarePaginator
     */
    public function allInstitutions($search, $sortField = "name", $sortDirection = "desc", $perPage = 10)
    {
        return Institution::where('name', 'like', '%' . $search . '%')
                            ->orWhere('acronym', 'like', '%' . $search . '%')
                            ->orWhere('type', 'like', '%' . $search . '%')
                            ->orWhere('ownership', 'like', '%' . $search . '%')
                            ->orWhere('code', 'like', '%' . $search . '%')
                            ->orWhere('location', 'like', '%' . $search . '%')
                            ->orderBy($sortField, $sortDirection)
                            ->paginate($perPage);
    }

    /**
     * Save details of an institution to the database
     * 
     * @param array $data Details of a particular institution
     * 
     * @return Illuminate\Database\Eloquent\Model
     */
    public function storeInstitution(array $data)
    {
        return Institution::create([
            'name' => $data['name'],
            'acronym' => $data['acronym'],
            'type' => $data['type'],
            'ownership' => $data['ownership'],
            'code' => $data['code'],
            'location' => $data['location'],
            'admission_portal_link' => $data['admission_portal_link'],
        ]);
    }

    /**
     * Retrieve an institution by its ID from the database
     * 
     * @param string $id Institution ID
     * 
     * @return Illuminate\Database\Eloquent\Model
     */
    public function findInstitution($id)
    {
        return Institution::findOrFail($id);
    }

    /**
     * Update details of an institution
     * 
     * @param array $data Details of a particular institution
     * @param string $id Institution ID
     * 
     * @return boolean
     */
    public function updateInstitution(array $data, string $id)
    {
        $institution = Institution::where('id', $id)->firstOrFail();
        $institution->name = $data['name'];
        $institution->acronym = $data['acronym'];
        $institution->type = $data['type'];
        $institution->ownership = $data['ownership'];
        $institution->code = $data['code'];
        $institution->location = $data['location'];
        $institution->admission_portal_link = $data['admission_portal_link'];
        return $institution->save();
    }

    /**
     * Permanently, delete an institution from the database
     * 
     * @param string $id Institution ID
     * 
     * @return integer Number of records deleted (0 for none)
     */
    public function destroyInstitution($id)
    {
        $institution = Institution::findOrFail($id);
        return $institution->delete();
    }

    /**
     * Add programs to an institution
     * 
     * @param array $data Details of a particular program
     * @param string $institution_id Institution ID
     * 
     * @return Illuminate\Database\Eloquent\Model
     */
    public function addProgram(array $data, string $institution_id)
    {
        $institution = Institution::findOrFail($institution_id);
        return $institution->programs()->create([
            'name' => $data['name'],
            'duration' => $data['duration'],
        ]);
    }
}