<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Career extends Model
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
        'field_id',
        'name',
    ];

    public function field(): BelongsTo
    {
        return $this->belongsTo(Field::class);
    }

    public function programs(): BelongsToMany
    {
        return $this->belongsToMany(Program::class, 'career_programs');
    }
}
