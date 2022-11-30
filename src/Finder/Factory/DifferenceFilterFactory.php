<?php

declare(strict_types=1);

namespace CodelyTV\FinderKata\Finder\Factory;

use CodelyTV\FinderKata\Finder\Filters\ClosestFilter;
use CodelyTV\FinderKata\Finder\Filters\FurthestFilter;
use CodelyTV\FinderKata\Finder\Interfaces\DifferenceFinderFilterInterface;
use CodelyTV\FinderKata\Finder\Option\Difference;
use InvalidArgumentException;

class DifferenceFilterFactory
{
    private const FILTERS_TYPES_MAPPING = [
        Difference::CLOSEST => ClosestFilter::class,
        Difference::FURTHEST => FurthestFilter::class,
    ];

    public function build(string $type): DifferenceFinderFilterInterface
    {
        if (!array_key_exists($type, self::FILTERS_TYPES_MAPPING)) {
            throw new InvalidArgumentException(sprintf('Type %s filter does not exist!', $type));
        }

        $filter = self::FILTERS_TYPES_MAPPING[$type];

        return new $filter();
    }
}
