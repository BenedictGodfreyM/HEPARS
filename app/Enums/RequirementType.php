<?php

namespace App\Enums;

enum RequirementType: string
{
    case REQUIRED = 'required';
    case OPTIONAL = 'optional';
    case NECESSARY = 'necessary';
}
