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
                            ->orWhere('rank', 'like', '%' . $search . '%')
                            ->orWhere('code', 'like', '%' . $search . '%')
                            ->orWhere('location', 'like', '%' . $search . '%')
                            ->orderBy($sortField, $sortDirection)
                            ->paginate($perPage);
    }

    /**
     * Retrieve all institutions from the database (Without Pagination)
     * 
     * @return Illuminate\Database\Eloquent\Collection
     */
    public function allInstitutionsWithoutPagination()
    {
        return Institution::query()->orderBy('name','asc')->get();
    }

    /**
     * Retrieve all mother institutions from the database (Without Pagination)
     * 
     * @return Illuminate\Database\Eloquent\Collection
     */
    public function allMotherInstitutionsWithoutPagination()
    {
        return Institution::query()->motherInstitutions()->orderBy('name','asc')->get();
    }

    /**
     * Retrieve all mother institutions from the database except a certain institution (Without Pagination)
     * 
     * @param string $institution_id An Institution to exclude from the list
     * 
     * @return Illuminate\Database\Eloquent\Collection
     */
    public function allMotherInstitutionsExceptWithoutPagination(string $institution_id)
    {
        return Institution::query()->motherInstitutionsExcept($institution_id)->orderBy('name','asc')->get();
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
            'affiliation_id' => $data['affiliation_id'],
            'name' => $data['name'],
            'acronym' => $data['acronym'],
            'type' => $data['type'],
            'ownership' => $data['ownership'],
            'code' => $data['code'],
            'location' => $data['location'],
            'admission_portal_link' => $data['admission_portal_link'],
            'rank' => $data['rank'],
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
        $institution->affiliation_id = $data['affiliation_id'];
        $institution->name = $data['name'];
        $institution->acronym = $data['acronym'];
        $institution->type = $data['type'];
        $institution->ownership = $data['ownership'];
        $institution->code = $data['code'];
        $institution->location = $data['location'];
        $institution->admission_portal_link = $data['admission_portal_link'];
        $institution->rank = $data['rank'];
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
            'competition_scale' => $data['competition_scale'],
            'duration' => $data['duration'],
        ]);
    }

    /**
     * Link a particular institution to a specific accreditation
     * 
     * @param string $institution_id
     * @param string $accreditation_id
     * 
     * @return void
     */
    public function linkToAccreditation(string $institution_id, string $accreditation_id)
    {
        $institution = Institution::findOrFail($institution_id);
        $institution->accreditations()->attach($accreditation_id);
    }

    /**
     * Synchronize a particular institution to multiple accreditations
     * 
     * @param string $institution_id
     * @param array $accreditations Array of IDs of specific accreditations
     * 
     * @return void
     */
    public function linkToAccreditations(string $institution_id, array $accreditations)
    {
        $institution = Institution::findOrFail($institution_id);
        $institution->accreditations()->sync($accreditations);
    }
}