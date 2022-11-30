<?php

declare(strict_types=1);

namespace CodelyTV\FinderKata\Finder\Interfaces;

use CodelyTV\FinderKata\Finder\DTO\PersonDifferenceResult;

interface DifferenceFinderFilterInterface
{
    public function filter(array $personDifferencesArray): PersonDifferenceResult;
}
