<?php

declare(strict_types = 1);

namespace CodelyTV\FinderKata\Algorithm;

final class PersonCalculationResult
{
    /** @var ?Person */
    private $firstPerson;

    /** @var ?Person */
    private $secondPerson;

    /** @var ?int */
    private $difference;

    public function __construct(Person $firstPerson = null, Person $secondPerson = null, int $difference = null)
    {
        $this->firstPerson = $firstPerson;
        $this->secondPerson = $secondPerson;
        $this->difference = $difference;
    }

    /**
     * @return Person|null
     */
    public function getFirstPerson()
    {
        return $this->firstPerson;
    }

    /**
     * @return Person|null
     */
    public function getSecondPerson()
    {
        return $this->secondPerson;
    }

    /**
     * @return int|null
     */
    public function getDifference()
    {
        return $this->difference;
    }
}
