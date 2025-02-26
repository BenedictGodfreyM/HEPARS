<?php

namespace App\Repositories;

use App\Models\Program;

class ProgramRepository
{
    /**
     * Get the total number of programs in the database
     * 
     * @return integer
     */
    public function totalPrograms()
    {
        return Program::count();
    }

    /**
     * Retrieve all programs from the database
     * 
     * @return Illuminate\Pagination\LengthAwarePaginator
     */
    public function allPrograms()
    {
        return Program::latest()->paginate(10);
    }

    /**
     * Retrieve a program by its ID from the database
     * 
     * @param string $id Program ID
     * 
     * @return Illuminate\Database\Eloquent\Model
     */
    public function findProgram($id)
    {
        return Program::findOrFail($id);
    }

    /**
     * Update details of a program
     * 
     * @param array $data Details of a particular program
     * @param string $id Program ID
     * 
     * @return boolean true if the update was successful, false otherwise
     */
    public function updateProgram(array $data, string $id)
    {
        $program = Program::where('id', $id)->firstOrFail();
        $program->institution_id = $data['institution_id'];
        $program->name = $data['name'];
        $program->duration = $data['duration'];
        return $program->save();
    }

    /**
     * Permanently, delete a program from the database
     * 
     * @param string $id Program ID
     * 
     * @return integer Number of records deleted (0 for none)
     */
    public function destroyProgram($id)
    {
        $program = Program::findOrFail($id);
        return $program->delete();
    }

    /**
     * Register entry requirements for a particular program
     * 
     * @param string $program_id
     * @param string $subject_id
     * @param string $min_grade
     * 
     * @return void
     */
    public function addEntryRequirement($program_id, $subject_id, $min_grade)
    {
        $program = Program::findOrFail($program_id);
        $program->subjects()->attach($subject_id, ['min_grade' => $min_grade]);
    }

    /**
     * Synchronize a particular program to multiple entry requirements
     * 
     * @param string $program_id
     * @param array $entry_requirements An array of $subject_id => ['min_grade' => $min_grade] mapping
     * 
     * @return void
     */
    public function addEntryRequirements(string $program_id, array $entry_requirements)
    {
        $program = Program::findOrFail($program_id);
        $program->subjects()->sync($entry_requirements);
    }

    /**
     * Link a particular program to a specific Career Path
     * 
     * @param string $program_id
     * @param string $career_path_id
     * 
     * @return void
     */
    public function linkToCareerPath(string $program_id, string $career_path_id)
    {
        $program = Program::findOrFail($program_id);
        $program->career_paths()->attach($career_path_id);
    }

    /**
     * Synchronize a particular program to multiple Career Paths
     * 
     * @param string $program_id
     * @param array $career_paths Array of IDs of specific Career Paths
     * 
     * @return void
     */
    public function linkToCareerPaths(string $program_id, array $career_paths)
    {
        $program = Program::findOrFail($program_id);
        $program->career_paths()->sync($career_paths);
    }
}