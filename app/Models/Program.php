<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Program extends Model
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
        'institution_id',
        'name',
        'duration',
    ];

    public function institution(): BelongsTo
    {
        return $this->belongsTo(Institution::class);
    }

    public function careers(): BelongsToMany
    {
        return $this->belongsToMany(Career::class, 'career_programs');
    }

    public function entryRequirements()
    {
        return $this->hasMany(EntryRequirement::class);
    }
}
