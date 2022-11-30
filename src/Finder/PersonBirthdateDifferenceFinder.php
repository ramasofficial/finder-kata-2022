<?php

declare(strict_types=1);

namespace CodelyTV\FinderKata\Finder;

use CodelyTV\FinderKata\Finder\DTO\PersonDifferenceResult;
use CodelyTV\FinderKata\Finder\Enum\Difference;
use CodelyTV\FinderKata\Finder\Factory\DifferenceFilterFactory;
use CodelyTV\FinderKata\Finder\Model\Person;
use Exception;

final class PersonBirthdateDifferenceFinder
{
    /**
     * @param Person[] $persons
     */
    public function __construct(private array $persons)
    {
    }

    /**
     * @throws Exception
     */
    public function find(Difference $difference): ?PersonDifferenceResult
    {
        $personDifferencesResults = $this->getPersonBirthdateDifferenceCalculationResults();

        if ($personDifferencesResults === []) {
            return null;
        }

        return $this->findDifferenceByType($difference, $personDifferencesResults);
    }

    /**
     * @throws Exception
     */
    private function getPersonBirthdateDifferenceCalculationResults(): array
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

                $results[] = new PersonDifferenceResult(
                    $firstPerson,
                    $secondPerson
                );
            }
            $iteration++;
        }

        return $results;
    }

    private function findDifferenceByType(Difference $difference, array $persons): PersonDifferenceResult
    {
        $personsDifferencesArray = [];
        foreach ($persons as $person) {
            $personsDifferencesArray[$person->getDifference()] = $person;
        }

        // Sorting by keys, because keys are difference number
        ksort($personsDifferencesArray);

        return (new DifferenceFilterFactory())
            ->build($difference)
            ->filter($personsDifferencesArray);
    }
}
