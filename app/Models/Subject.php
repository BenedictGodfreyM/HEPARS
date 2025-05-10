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
    ];

    public function entryRequirements(): BelongsToMany
    {
        return $this->belongsToMany(EntryRequirement::class, 'entry_requirement_subjects')->using(EntryRequirementSubject::class)->withPivot('type','min_grade');
    }

    public function combinations(): BelongsToMany
    {
        return $this->belongsToMany(Combination::class, 'combination_subjects');
    }
}
