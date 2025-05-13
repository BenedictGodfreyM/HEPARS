<?php

namespace App\Repositories;

use App\Models\Program;
use Illuminate\Database\Eloquent\Builder;

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
    public function allPrograms($search, $sortField = "name", $sortDirection = "desc", $perPage = 10)
    {
        return Program::where('name', 'like', '%' . $search . '%')
                        ->orWhere('duration', 'like', '%' . $search . '%')
                        ->orderBy($sortField, $sortDirection)
                        ->paginate($perPage);
    }

    /**
     * Retrieve all programs offered by a certain institution
     * 
     * @return Illuminate\Pagination\LengthAwarePaginator
     */
    public function institutionPrograms($institution_id, $search, $sortField = "name", $sortDirection = "desc", $perPage = 10)
    {
        return Program::where('institution_id', '=', $institution_id)
                        ->where(function(Builder $query) use($search){
                            $query->where('name', 'like', '%' . $search . '%')
                                    ->orWhere('duration', 'like', '%' . $search . '%');
                        })
                        ->orderBy($sortField, $sortDirection)
                        ->paginate($perPage);
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
     * @param array $data Details of a particular entry requirement
     * 
     * @return Illuminate\Database\Eloquent\Model
     */
    public function addEntryRequirement($program_id, $data)
    {
        $program = Program::findOrFail($program_id);
        return $program->entryRequirements()->create([
            'min_total_points' => $data['min_total_points'],
            'required_subjects_count' => $data['required_subjects_count'],
        ]);
    }

    /**
     * Remove all Entry Requirements from a particular program
     * 
     * @param string $program_id
     * 
     * @return void
     */
    public function removeEntryRequirements(string $program_id)
    {
        $program = Program::findOrFail($program_id);
        $program->entryRequirements()->delete();
    }

    /**
     * Link a particular program to a specific Career Path
     * 
     * @param string $program_id
     * @param string $career_id
     * 
     * @return void
     */
    public function linkToCareer(string $program_id, string $career_id)
    {
        $program = Program::findOrFail($program_id);
        $program->careers()->attach($career_id);
    }

    /**
     * Synchronize a particular program to multiple Career Paths
     * 
     * @param string $program_id
     * @param array $careers Array of IDs of specific Careers
     * 
     * @return void
     */
    public function linkToCareers(string $program_id, array $careers)
    {
        $program = Program::findOrFail($program_id);
        $program->careers()->sync($careers);
    }
}