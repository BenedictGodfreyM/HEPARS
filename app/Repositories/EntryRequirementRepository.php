<?php

namespace App\Repositories;

use App\Models\EntryRequirement;
use App\Models\Program;

class EntryRequirementRepository
{
    /**
     * Retrieve a specific entry requirement by its ID from the database
     * 
     * @param string $id Entry Requirement ID
     * 
     * @return Illuminate\Database\Eloquent\Model
     */
    public function findEntryRequirement($id)
    {
        return EntryRequirement::findOrFail($id);
    }

    /**
     * Register subjects details for a particular program entry requirement
     * 
     * @param string $entry_requirement_id
     * @param string $subject_id
     * @param string $min_grade
     * @param string $requirement_type (Either required, necessary or optional)
     * 
     * @return void
     */
    public function addEntryRequirementSubject($entry_requirement_id, $subject_id, $min_grade, $requirement_type)
    {
        $entry_requirement = EntryRequirement::findOrFail($entry_requirement_id);
        $entry_requirement->subjects()->attach($subject_id, ['type' => $requirement_type,'min_grade' => $min_grade]);
    }

    /**
     * Synchronize a particular program entry requirement to multiple subjects
     * 
     * @param string $entry_requirement_id
     * @param array $subjects An array of $subject_id => ['min_grade' => $min_grade, 'type' => $requirement_type] mapping
     * 
     * @return void
     */
    public function addEntryRequirementSubjects(string $entry_requirement_id, array $subjects)
    {
        $entry_requirement = EntryRequirement::findOrFail($entry_requirement_id);
        $entry_requirement->subjects()->sync($subjects);
    }

    /**
     * Remove all subjects from a particular Program Entry Requirement
     * 
     * @param string $entry_requirement_id
     * 
     * @return void
     */
    public function detachEntryRequirementSubjects(string $entry_requirement_id)
    {
        $entry_requirement = EntryRequirement::findOrFail($entry_requirement_id);
        $entry_requirement->subjects()->detach();
    }
}