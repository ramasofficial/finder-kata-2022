<?php

declare(strict_types=1);

namespace CodelyTV\FinderKata\Algorithm;

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

    public function find(int $ft): PersonCalculationResult
    {
        $results = $this->getPersonBirthdateCalculationResults();

        if (count($results) <= 0) {
            return new PersonCalculationResult();
        }

        return $this->findFinalResult($results, $ft);
    }

    private function getPersonBirthdateCalculationResults(): array
    {
        /** @var PersonCalculationResult[] $results */
        $results = [];
        $iteration = 0;
        foreach ($this->persons as $person) {
            for ($j = $iteration + 1; $j < count($this->persons); $j++) {

                if ($this->persons[$iteration]->getBirthDate() < $this->persons[$j]->getBirthDate()) {
                    $firstPerson = $this->persons[$iteration];
                    $secondPerson = $this->persons[$j];
                    $difference = $secondPerson->getBirthDate()->getTimestamp() - $firstPerson->getBirthDate()->getTimestamp();

                    $results[] = new PersonCalculationResult(
                        $firstPerson,
                        $secondPerson,
                        $difference
                    );

                    continue;
                }

                $firstPerson = $this->persons[$j];
                $secondPerson = $this->persons[$iteration];
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

    private function findFinalResult(array $results, int $ft)
    {
        $personCalculationResult = $results[0];

        foreach ($results as $result) {
            if ($ft === FT::ONE && $result->getDifference() < $personCalculationResult->getDifference()) {
                $personCalculationResult = $result;
                continue;
            }

            if ($ft === FT::TWO && $result->getDifference() > $personCalculationResult->getDifference()) {
                $personCalculationResult = $result;
            }
        }

        return $personCalculationResult;
    }
}
