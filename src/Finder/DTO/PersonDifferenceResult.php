<?php

declare(strict_types=1);

namespace CodelyTV\FinderKata\Finder\DTO;

use CodelyTV\FinderKata\Finder\Model\Person;
use Exception;

final class PersonDifferenceResult
{
    public function __construct(
        private ?Person $firstPerson = null,
        private ?Person $secondPerson = null
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

    /**
     * @throws Exception
     */
    public function getDifference(): ?int
    {
        if (!$this->firstPerson || !$this->secondPerson) {
            return null;
        }

        return $this->secondPerson->getBirthDate()->getTimestamp() - $this->firstPerson->getBirthDate()->getTimestamp();
    }
}
