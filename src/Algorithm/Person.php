<?php

declare(strict_types = 1);

namespace CodelyTV\FinderKata\Algorithm;

use DateTime;
use Exception;

final class Person
{
    /** @var string */
    private $name;

    /** @var DateTime */
    private $birthDate;

    public function __construct(string $name, string $birthDate)
    {
        $this->name = $name;
        $this->birthDate = $birthDate;
    }

    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @throws Exception
     */
    public function getBirthDate(): DateTime
    {
        return new DateTime($this->birthDate);
    }
}
