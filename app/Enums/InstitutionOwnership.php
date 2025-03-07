<?php

namespace App\Enums;

enum InstitutionOwnership: string
{
    case PRIVATE_INSTITUTION = 'Private';
    case PUBLIC_INSTITUTION = 'Public';
}