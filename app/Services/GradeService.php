<?php

namespace App\Services;

class GradeService
{
    public static function getPoints(string $grade): float
    {
        $pointsMap = ['A' => '5', 'B' => '4', 'C' => '3', 'D' => '2', 'E' => '1', 'S' => '0.5', 'F' => 0];
        return $pointsMap[$grade] ?? 0;
    }
}