<?php

namespace App\Enums;

enum RequirementType: string
{
    case COMPULSORY = 'compulsory';
    case NECESSARY = 'necessary';
    case OPTIONAL = 'optional';
}
