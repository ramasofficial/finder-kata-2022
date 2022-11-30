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
        foreach ($this->persons as $key => $person) {
            unset($this->persons[$key]);

            foreach ($this->persons as $comparePerson) {
                if ($person->getBirthDate() < $comparePerson->getBirthDate()) {
                    $results[] = new PersonDifferenceResult(
                        $person,
                        $comparePerson
                    );

                    continue;
                }

                $results[] = new PersonDifferenceResult(
                    $comparePerson,
                    $person
                );
            }
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
