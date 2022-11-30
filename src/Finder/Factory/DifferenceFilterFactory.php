<?php

declare(strict_types=1);

namespace CodelyTV\FinderKata\Finder\Factory;

use CodelyTV\FinderKata\Finder\Filters\ClosestFilter;
use CodelyTV\FinderKata\Finder\Filters\FurthestFilter;
use CodelyTV\FinderKata\Finder\Interfaces\DifferenceFinderFilterInterface;
use CodelyTV\FinderKata\Finder\Enum\Difference;
use InvalidArgumentException;

class DifferenceFilterFactory
{
    private const FILTERS_TYPES_MAPPING = [
        'closest' => ClosestFilter::class,
        'furthest' => FurthestFilter::class,
    ];

    public function build(Difference $differenceType): DifferenceFinderFilterInterface
    {
        if (!array_key_exists($differenceType->value, self::FILTERS_TYPES_MAPPING)) {
            throw new InvalidArgumentException(sprintf('Type %s filter does not exist!', $differenceType));
        }

        $filter = self::FILTERS_TYPES_MAPPING[$differenceType->value];

        return new $filter();
    }
}
