<?php

declare(strict_types = 1);

namespace CodelyTV\FinderKata\Algorithm;

final class Finder
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
        /** @var PersonCalculationResult[] $tr */
        $tr = [];

        $iteration = 0;
        foreach ($this->persons as $key => $person) {
            for ($j = $iteration + 1; $j < count($this->persons); $j++) {

                if ($this->persons[$iteration]->getBirthDate() < $this->persons[$j]->getBirthDate()) {
                    $firstPerson = $this->persons[$iteration];
                    $secondPerson = $this->persons[$j];
                    $difference = $secondPerson->getBirthDate()->getTimestamp() - $firstPerson->getBirthDate()->getTimestamp();

                    $result = new PersonCalculationResult(
                        $firstPerson,
                        $secondPerson,
                        $difference
                    );
                } else {
                    $firstPerson = $this->persons[$j];
                    $secondPerson = $this->persons[$iteration];
                    $difference = $secondPerson->getBirthDate()->getTimestamp() - $firstPerson->getBirthDate()->getTimestamp();

                    $result = new PersonCalculationResult(
                        $firstPerson,
                        $secondPerson,
                        $difference
                    );
                }

                $tr[] = $result;
            }
            $iteration++;
        }

        if (count($tr) < 1) {
            return new PersonCalculationResult();
        }

        $answer = $tr[0];

        foreach ($tr as $result) {
            switch ($ft) {
                case FT::ONE:
                    if ($result->getDifference() < $answer->getDifference()) {
                        $answer = $result;
                    }
                    break;

                case FT::TWO:
                    if ($result->getDifference() > $answer->getDifference()) {
                        $answer = $result;
                    }
                    break;
            }
        }

        return $answer;
    }
}
