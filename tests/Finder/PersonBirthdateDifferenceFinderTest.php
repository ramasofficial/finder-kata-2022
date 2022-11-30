<?php

declare(strict_types=1);

namespace CodelyTV\FinderKataTest\Finder;

use CodelyTV\FinderKata\Finder\PersonBirthdateDifferenceFinder;
use CodelyTV\FinderKata\Finder\Enum\Difference;
use CodelyTV\FinderKata\Finder\Model\Person;
use Exception;
use Generator;
use PHPUnit\Framework\TestCase;

final class PersonBirthdateDifferenceFinderTest extends TestCase
{
    /**
     * @dataProvider finderDataProvider
     * @throws Exception
     */
    public function testFinderWorksCorrect(
        array $list,
        ?array $expected,
        Difference $difference
    ): void {
        $finder = new PersonBirthdateDifferenceFinder($list);

        $result = $finder->find($difference);

        if (!$expected) {
            $this->assertNull($result);
            return;
        }

        $this->assertEquals($expected[0], $result->getFirstPerson());
        $this->assertEquals($expected[1], $result->getSecondPerson());
    }

    public function finderDataProvider(): Generator
    {
        $sue = new Person('Sue', '1950-01-01');
        $greg = new Person('Greg', '1952-05-01');
        $sarah = new Person('Sarah', '1982-01-01');
        $mike = new Person('Mike', '1979-01-01');

        yield 'Example should return empty when given empty list' => [
            'list' => [],
            'expected' => null,
            'difference' => Difference::CLOSEST,
        ];

        yield 'Example should return empty when given one person' => [
            'list' => [
                $sue,
            ],
            'expected' => null,
            'difference' => Difference::CLOSEST,
        ];

        yield 'Example should return closest two for two people' => [
            'list' => [
                $sue,
                $greg,
            ],
            'expected' => [
                $sue,
                $greg,
            ],
            'difference' => Difference::CLOSEST,
        ];

        yield 'Example should return furthest two for two people' => [
            'list' => [
                $mike,
                $greg,
            ],
            'expected' => [
                $greg,
                $mike,
            ],
            'difference' => Difference::FURTHEST,
        ];

        yield 'Example should return furthest two for four people' => [
            'list' => [
                $sue,
                $sarah,
                $mike,
                $greg,
            ],
            'expected' => [
                $sue,
                $sarah,
            ],
            'difference' => Difference::FURTHEST,
        ];

        yield 'Example should return closest two for four people' => [
            'list' => [
                $sue,
                $sarah,
                $mike,
                $greg,
            ],
            'expected' => [
                $sue,
                $greg,
            ],
            'difference' => Difference::CLOSEST,
        ];
    }
}
