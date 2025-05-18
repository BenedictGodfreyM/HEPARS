<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Combination extends Model
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
        'category',
    ];

    public function subjects(): BelongsToMany
    {
        return $this->belongsToMany(Subject::class, 'combination_subjects');
    }
}
