<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Subject extends Model
{
    use Uuids;
    
    /**
     * The Primary Key Attribute.
     *
     * @var string
     */
    public $primaryKey  = 'id';

    /**
     * Indicates if the Primary-Key Should be Incremented.
     *
     * @var bool
     */
    public $incrementing = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'code',
        'is_compulsory',
        'is_additional',
    ];

    protected $casts = [
        'is_compulsory' => 'boolean',
        'is_additional' => 'boolean',
    ];
    
    /**
     * Get the text response if a subject must be taken (by all students) in addition to other subjects.
     * 
     * @return string
     */
    public function getCompulsoryAttribute(): string
    {
        return (($this->is_compulsory) ? "Yes" : "No");
    }
    
    /**
     * Get the text response if a subject can be taken in addition to other subjects.
     * 
     * @return string
     */
    public function getAdditionalAttribute(): string
    {
        return (($this->is_additional) ? "Yes" : "No");
    }

    public function entryRequirements(): BelongsToMany
    {
        return $this->belongsToMany(EntryRequirement::class, 'entry_requirement_subjects')->using(EntryRequirementSubject::class)->withPivot('type','min_grade');
    }

    public function combinations(): BelongsToMany
    {
        return $this->belongsToMany(Combination::class, 'combination_subjects');
    }
}
