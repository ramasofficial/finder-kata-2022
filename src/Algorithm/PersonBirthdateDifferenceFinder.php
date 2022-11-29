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
    public function find(int $differenceType): PersonDifferenceResult
    {
        $personDifferencesResults = $this->getPersonBirthdateCalculationResults();

        if ($personDifferencesResults === []) {
            return new PersonDifferenceResult();
        }

        return $this->findDifference($differenceType, $personDifferencesResults);
    }

    /**
     * @throws Exception
     */
    private function getPersonBirthdateCalculationResults(): array
    {
        /** @var PersonDifferenceResult[] $results */
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

                $results[] = new PersonDifferenceResult(
                    $firstPerson,
                    $secondPerson,
                    $difference
                );
            }
            $iteration++;
        }

        return $results;
    }

    private function findDifference(int $differenceType, array $persons): PersonDifferenceResult
    {
        $personsDifferencesArray = [];
        foreach ($persons as $person) {
            $personsDifferencesArray[$person->getDifference()] = $person;
        }

        // Sort it by keys
        ksort($personsDifferencesArray);

        if ($differenceType === Difference::CLOSEST) {
            return array_values($personsDifferencesArray)[0];
        }

        return end($personsDifferencesArray);
    }
}
