<?php

use App\Models\EntryRequirement;
use App\Services\EntryRequirementFormatterService;

if(! function_exists(('format_entry_requirements'))){
    function format_entry_requirements(EntryRequirement $requirement)
    {
        return (new EntryRequirementFormatterService)->format($requirement);
    }
}