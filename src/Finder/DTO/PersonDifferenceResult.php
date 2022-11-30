<?php

declare(strict_types=1);

namespace CodelyTV\FinderKata\Finder\DTO;

use CodelyTV\FinderKata\Finder\Model\Person;

final class PersonDifferenceResult
{
    public function __construct(
        private ?Person $firstPerson = null,
        private ?Person $secondPerson = null,
        private ?int $difference = null
    ) {
    }

    public function getFirstPerson(): ?Person
    {
        return $this->firstPerson;
    }

    public function getSecondPerson(): ?Person
    {
        return $this->secondPerson;
    }

    public function getDifference(): ?int
    {
        return $this->difference;
    }
}
