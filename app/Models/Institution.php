<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Builder;

class Institution extends Model
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
        'affiliation_id',
        'name',
        'acronym',
        'type',
        'ownership',
        'code',
        'location',
        'admission_portal_link',
        'rank'
    ];

    /**
     * Get the institution's accreditation status (Eg. Accredited and Chartered, Accredited, e.t.c)
     * 
     * @return string
     */
    public function getAccreditationStatusAttribute(): string
    {
        $items = $this->accreditations->sortBy('status')->pluck('status')->toArray();
        $items = array_values($items);
        $count = count($items);
        if ($count === 0) return 'N/A';
        if ($count === 1) return "{$items[0]}";
        if ($count === 2) return "{$items[0]} and {$items[1]}";

        return implode(', ', array_slice($items, 0, -1)) . " and " . end($items);
    }

    /**
     * Get all mother institutions.
     * 
     * @param Illuminate\Database\Eloquent\Builder $query
     * 
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeMotherInstitutions(Builder $query): Builder
    {
        return $query->whereNull('affiliation_id');
    }

    /**
     * Get all mother institutions except a certain institution.
     * 
     * @param Illuminate\Database\Eloquent\Builder $query
     * @param string $institution_id An Institution to exclude from the list
     * 
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeMotherInstitutionsExcept(Builder $query, string $institution_id): Builder
    {
        return $query->whereNull('affiliation_id')->where('id', '<>', $institution_id);
    }
    
    public function affiliates(): HasMany
    {
        return $this->hasMany(Institution::class, 'affiliation_id');
    }
    
    public function affiliatedTo(): BelongsTo
    {
        return $this->belongsTo(Institution::class, 'affiliation_id');
    }

    public function programs(): HasMany
    {
        return $this->hasMany(Program::class);
    }

    public function accreditations(): BelongsToMany
    {
        return $this->belongsToMany(Accreditation::class, 'accreditation_institutions');
    }
}
