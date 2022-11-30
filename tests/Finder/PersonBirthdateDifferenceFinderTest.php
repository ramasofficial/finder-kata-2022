<?php

declare(strict_types=1);

namespace CodelyTV\FinderKataTest\Finder;

use CodelyTV\FinderKata\Finder\PersonBirthdateDifferenceFinder;
use CodelyTV\FinderKata\Finder\Enum\Difference;
use CodelyTV\FinderKata\Finder\Model\Person;
use Exception;
use PHPUnit\Framework\TestCase;

final class PersonBirthdateDifferenceFinderTest extends TestCase
{
    private Person $sue;
    private Person $greg;
    private Person $sarah;
    private Person $mike;

    protected function setUp(): void
    {
        $this->sue = new Person('Sue', '1950-01-01');
        $this->greg = new Person('Greg', '1952-05-01');
        $this->sarah = new Person('Sarah', '1982-01-01');
        $this->mike = new Person('Mike', '1979-01-01');
    }

    // TODO: rewrite tests with DATA PROVIDER

    /**
     * @throws Exception
     */
    public function testShouldReturnEmptyWhenGivenEmptyList(): void
    {
        $list = [];
        $finder = new PersonBirthdateDifferenceFinder($list);

        $result = $finder->find(Difference::CLOSEST);

        $this->assertNull($result);
    }

    /**
     * @throws Exception
     */
    public function testShouldReturnEmptyWhenGivenOnePerson(): void
    {
        $list = [];
        $list[] = $this->sue;
        $finder = new PersonBirthdateDifferenceFinder($list);

        $result = $finder->find(Difference::CLOSEST);

        $this->assertNull($result);
    }

    /**
     * @throws Exception
     */
    public function testShouldReturnClosestTwoForTwoPeople(): void
    {
        $list = [];
        $list[] = $this->sue;
        $list[] = $this->greg;
        $finder = new PersonBirthdateDifferenceFinder($list);

        $result = $finder->find(Difference::CLOSEST);

        $this->assertEquals($this->sue, $result->getFirstPerson());
        $this->assertEquals($this->greg, $result->getSecondPerson());
    }

    /**
     * @throws Exception
     */
    public function testShouldReturnFurthestTwoForTwoPeople(): void
    {
        $list = [];
        $list[] = $this->mike;
        $list[] = $this->greg;
        $finder = new PersonBirthdateDifferenceFinder($list);

        $result = $finder->find(Difference::FURTHEST);

        $this->assertEquals($this->greg, $result->getFirstPerson());
        $this->assertEquals($this->mike, $result->getSecondPerson());
    }

    /**
     * @throws Exception
     */
    public function testShouldReturnFurthestTwoForFourPeople(): void
    {
        $list = [];
        $list[] = $this->sue;
        $list[] = $this->sarah;
        $list[] = $this->mike;
        $list[] = $this->greg;
        $finder = new PersonBirthdateDifferenceFinder($list);

        $result = $finder->find(Difference::FURTHEST);

        $this->assertEquals($this->sue, $result->getFirstPerson());
        $this->assertEquals($this->sarah, $result->getSecondPerson());
    }

    /**
     * @throws Exception
     */
    public function testShouldReturnClosestTwoForFourPeople(): void
    {
        $list = [];
        $list[] = $this->sue;
        $list[] = $this->sarah;
        $list[] = $this->mike;
        $list[] = $this->greg;
        $finder = new PersonBirthdateDifferenceFinder($list);

        $result = $finder->find(Difference::CLOSEST);

        $this->assertEquals($this->sue, $result->getFirstPerson());
        $this->assertEquals($this->greg, $result->getSecondPerson());
    }
}
