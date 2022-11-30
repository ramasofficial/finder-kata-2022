<?php

declare(strict_types=1);

namespace CodelyTV\FinderKata\Finder\Enum;

enum Difference: string
{
    case CLOSEST = 'closest';
    case FURTHEST = 'furthest';
}
