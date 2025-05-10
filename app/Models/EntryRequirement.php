<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class EntryRequirement extends Model
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
        'program_id',
        'min_total_points',
        'required_subjects_count',
    ];

    protected $casts = [
        'min_total_points' => 'integer',
        'required_subjects_count' => 'integer',
    ];

    public function program()
    {
        return $this->belongsTo(Program::class);
    }

    public function subjects(): BelongsToMany
    {
        return $this->belongsToMany(Subject::class, 'entry_requirement_subjects')->using(EntryRequirementSubject::class)->withPivot('type','min_grade');
    }
}
