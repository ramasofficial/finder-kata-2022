<?php

declare(strict_types=1);

namespace CodelyTV\FinderKata\Algorithm;

use Exception;

final class PersonBirthdateDifferenceFinder
{
    /** @var Person[] */
    private $persons;

    /**
     * @param Person[] $persons
     */
    public function __construct(array $persons)
    {
        $this->persons = $persons;
    }

    /**
     * @throws Exception
     */
    public function find(int $differenceType): PersonCalculationResult
    {
        $results = $this->getPersonBirthdateCalculationResults();

        if (count($results) <= 0) {
            return new PersonCalculationResult();
        }

        return $this->findDifference($differenceType, $results);
    }

    /**
     * @throws Exception
     */
    private function getPersonBirthdateCalculationResults(): array
    {
        /** @var PersonCalculationResult[] $results */
        $results = [];
        $iteration = 0;
        foreach ($this->persons as $person) {
            for ($j = $iteration + 1; $j < count($this->persons); $j++) {

                if ($person->getBirthDate() < $this->persons[$j]->getBirthDate()) {
                    $firstPerson = $person;
                    $secondPerson = $this->persons[$j];
                } else {
                    $firstPerson = $this->persons[$j];
                    $secondPerson = $person;
                }

                $difference = $secondPerson->getBirthDate()->getTimestamp() - $firstPerson->getBirthDate()->getTimestamp();

                $results[] = new PersonCalculationResult(
                    $firstPerson,
                    $secondPerson,
                    $difference
                );
            }
            $iteration++;
        }

        return $results;
    }

    private function findDifference(int $differenceType, array $results)
    {
        $personCalculationResult = $results[0];

        foreach ($results as $result) {
            if ($differenceType === Difference::CLOSEST && $result->getDifference() < $personCalculationResult->getDifference()) {
                $personCalculationResult = $result;
                continue;
            }

            if ($differenceType === Difference::FURTHEST && $result->getDifference() > $personCalculationResult->getDifference()) {
                $personCalculationResult = $result;
            }
        }

        return $personCalculationResult;
    }
}
