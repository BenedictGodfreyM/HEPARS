<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Accreditation extends Model
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
        'status',
        'rating',
        'description',
    ];

    protected $casts = [
        'rating' => 'integer',
    ];
    
    /**
     * Get the percentage of autonomy symbolised by the accreditation status'
     * 
     * @return string
     */
    public function getAutonomyAttribute(): string
    {
        $maxRating = self::max('rating');

        // Prevent division by zero
        if ($maxRating === 0) return 0;

        return (round((($this->rating / $maxRating) * 100), 0, PHP_ROUND_HALF_DOWN) . "%");
    }

    public function institutions(): BelongsToMany
    {
        return $this->belongsToMany(Institution::class, 'accreditation_institutions');
    }
}
