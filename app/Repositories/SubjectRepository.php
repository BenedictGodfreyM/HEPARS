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
    public function allSubjects()
    {
        return Subject::latest()->paginate(10);
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