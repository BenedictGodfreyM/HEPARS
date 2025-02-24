<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class EntryRequirement extends Pivot
{
    /**
     * Indicates if the Primary-Key Should be Incremented.
     *
     * @var bool
     */
    public $incrementing = true;
}
