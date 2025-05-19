<?php

namespace App\Repositories;

use App\Models\Subject;

class SubjectRepository
{
    /**
     * Get the total number of subjects in the database
     * 
     * @return integer
     */
    public function totalSubjects()
    {
        return Subject::count();
    }

    /**
     * Retrieve all subjects from the database
     * 
     * @return Illuminate\Pagination\LengthAwarePaginator
     */
    public function allSubjects($search, $sortField = "name", $sortDirection = "desc", $perPage = 10)
    {
        return Subject::where('name', 'like', '%' . $search . '%')
                        ->orWhere('code', 'like', '%' . $search . '%')
                        ->orWhere('is_compulsory', 'like', '%' . $search . '%')
                        ->orWhere('is_additional', 'like', '%' . $search . '%')
                        ->orderBy($sortField, $sortDirection)
                        ->paginate($perPage);
    }

    /**
     * Retrieve all subjects from the database (Without Pagination)
     * 
     * @return Illuminate\Database\Eloquent\Collection
     */
    public function allSubjectsWithoutPagination()
    {
        return Subject::query()->orderBy('name','asc')->get();
    }

    /**
     * Retrieve all subjects that are neither compulsory nor additional (Without Pagination)
     * 
     * @return Illuminate\Database\Eloquent\Collection
     */
    public function allSubjectsNotCompulsoryAndAdditionalWithoutPagination()
    {
        return Subject::query()->where('is_compulsory', false)
                                ->where('is_additional', false)
                                ->orderBy('name','asc')->get();
    }

    /**
     * Save details of a subject to the database
     * 
     * @param array $data Details of a particular subject
     * 
     * @return Illuminate\Database\Eloquent\Model
     */
    public function storeSubject(array $data)
    {
        return Subject::create([
            'name' => $data['name'],
            'code' => $data['code'],
            'is_compulsory' => $data['is_compulsory'],
            'is_additional' => $data['is_additional'],
        ]);
    }

    /**
     * Retrieve a subject by its ID from the database
     * 
     * @param string $id subject ID
     * 
     * @return Illuminate\Database\Eloquent\Model
     */
    public function findSubject($id)
    {
        return Subject::findOrFail($id);
    }

    /**
     * Update details of a subject
     * 
     * @param array $data Details of a particular subject
     * @param string $id subject ID
     * 
     * @return boolean
     */
    public function updateSubject(array $data, string $id)
    {
        $subject = Subject::where('id', $id)->firstOrFail();
        $subject->name = $data['name'];
        $subject->code = $data['code'];
        $subject->is_compulsory = $data['is_compulsory'];
        $subject->is_additional = $data['is_additional'];
        return $subject->save();
    }

    /**
     * Permanently, delete a subject from the database
     * 
     * @param string $id subject ID
     * 
     * @return integer Number of records deleted (0 for none)
     */
    public function destroySubject($id)
    {
        $subject = Subject::findOrFail($id);
        return $subject->delete();
    }
}