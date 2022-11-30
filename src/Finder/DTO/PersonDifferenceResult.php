<?php

declare(strict_types=1);

namespace CodelyTV\FinderKata\Finder\DTO;

use CodelyTV\FinderKata\Finder\Model\Person;
use Exception;

final class PersonDifferenceResult
{
    public function __construct(
        private Person $firstPerson,
        private Person $secondPerson
    ) {
    }

    public function getFirstPerson(): Person
    {
        return $this->firstPerson;
    }

    public function getSecondPerson(): Person
    {
        return $this->secondPerson;
    }

    /**
     * @throws Exception
     */
    public function getDifference(): int
    {
        return $this->secondPerson->getBirthDate()->getTimestamp() - $this->firstPerson->getBirthDate()->getTimestamp();
    }
}
