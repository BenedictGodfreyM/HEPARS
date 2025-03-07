<?php

namespace App\Enums;

enum InstitutionType: string
{
    case UNIVERSITY = 'University';
    case UNIVERSITY_COLLEGE = 'University College';
    case UNIVERSITY_CAMPUS_COLLEGE = 'University Campus College';
    case NON_UNIVERSITY = 'Non-University';
}
