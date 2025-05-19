<?php

namespace App\Enums;

enum ProgramCompetitionScale: string
{
    case HIGH_COMPETITION = 'High Competition';
    case MODERATE_COMPETITION = 'Moderate Competition';
    case LOW_COMPETITION = 'Low Competition';
}