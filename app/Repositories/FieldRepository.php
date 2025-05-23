<?php

namespace App\Repositories;

use App\Models\Field;

class FieldRepository
{
    /**
     * Get the total number of fields in the database
     * 
     * @return integer
     */
    public function totalFields()
    {
        return Field::count();
    }

    /**
     * Retrieve all fields from the database
     * 
     * @return Illuminate\Pagination\LengthAwarePaginator
     */
    public function allFields($search, $sortField = "name", $sortDirection = "desc", $perPage = 10)
    {
        return Field::where('name', 'like', '%' . $search . '%')
                            ->orderBy($sortField, $sortDirection)
                            ->paginate($perPage);
    }

    /**
     * Retrieve all fields from the database (Without Pagination, Sorting and Search Features)
     * 
     * @return Illuminate\Database\Eloquent\Collection
     */
    public function allFieldsWithoutPagination()
    {
        return Field::query()->orderBy('name','asc')->get();
    }
    
    /**
     * Retrieve all fields associated with provided subjects.
     * 
     * @param array $subjects Array of IDs of specific Subjects
     * 
     * @return Illuminate\Database\Eloquent\Collection
     */
    public function allFieldsAssociatedWith($subjects)
    {
        return Field::query()->whereHas('careers.programs.entryRequirements.subjects', function ($query) use ($subjects) {
            $query->whereIn('subjects.id', $subjects);
        })->with(['careers.programs.entryRequirements.subjects'])->get();
    }

    /**
     * Save details of a field to the database
     * 
     * @param array $data Details of a particular field
     * 
     * @return Illuminate\Database\Eloquent\Model
     */
    public function storeField(array $data)
    {
        return Field::create([
            'name' => $data['name'],
        ]);
    }

    /**
     * Retrieve a field by its ID from the database
     * 
     * @param string $id field ID
     * 
     * @return Illuminate\Database\Eloquent\Model
     */
    public function findField($id)
    {
        return Field::findOrFail($id);
    }

    /**
     * Update details of a field
     * 
     * @param array $data Details of a particular field
     * @param string $id field ID
     * 
     * @return boolean
     */
    public function updateField(array $data, string $id)
    {
        $field = Field::where('id', $id)->firstOrFail();
        $field->name = $data['name'];
        return $field->save();
    }

    /**
     * Permanently, delete a field from the database
     * 
     * @param string $id field ID
     * 
     * @return integer Number of records deleted (0 for none)
     */
    public function destroyField($id)
    {
        $field = Field::findOrFail($id);
        return $field->delete();
    }

    /**
     * Add careers to a field
     * 
     * @param array $data Details of a particular career
     * @param string $field_id field ID
     * 
     * @return Illuminate\Database\Eloquent\Model
     */
    public function addCareer(array $data, string $field_id)
    {
        $field = Field::findOrFail($field_id);
        return $field->careers()->create([
            'name' => $data['name'],
        ]);
    }
}