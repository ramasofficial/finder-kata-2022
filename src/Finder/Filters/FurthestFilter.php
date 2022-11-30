<?php

declare(strict_types=1);

namespace CodelyTV\FinderKata\Finder\Filters;

use CodelyTV\FinderKata\Finder\DTO\PersonDifferenceResult;
use CodelyTV\FinderKata\Finder\Interfaces\DifferenceFinderFilterInterface;

class FurthestFilter implements DifferenceFinderFilterInterface
{
    public function filter(array $personDifferencesArray): PersonDifferenceResult
    {
        return end($personDifferencesArray);
    }
}
