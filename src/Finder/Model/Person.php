<?php

declare(strict_types=1);

namespace CodelyTV\FinderKata\Finder\Model;

use DateTime;
use Exception;

final class Person
{
    public function __construct(
        private readonly string $name,
        private readonly string $birthDate
    ) {
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
