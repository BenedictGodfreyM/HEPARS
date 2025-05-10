<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class EntryRequirementSubject extends Pivot
{
    /**
     * Indicates if the Primary-Key Should be Incremented.
     *
     * @var bool
     */
    public $incrementing = true;
}
