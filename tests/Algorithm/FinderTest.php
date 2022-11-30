<?php

declare(strict_types = 1);

namespace CodelyTV\FinderKataTest\Algorithm;

use CodelyTV\FinderKata\Finder\PersonBirthdateDifferenceFinder;
use CodelyTV\FinderKata\Finder\Option\Difference;
use CodelyTV\FinderKata\Finder\Model\Person;
use PHPUnit\Framework\TestCase;

final class FinderTest extends TestCase
{
    /** @var Person */
    private $sue;

    /** @var Person */
    private $greg;

    /** @var Person */
    private $sarah;

    /** @var Person */
    private $mike;

    protected function setUp(): void
    {
        $this->sue = new Person('Sue', '1950-01-01');
        $this->greg = new Person('Greg', '1952-05-01');
        $this->sarah = new Person('Sarah', '1982-01-01');
        $this->mike = new Person('Mike', '1979-01-01');
    }

    /** @test */
    public function should_return_empty_when_given_empty_list()
    {
        $list   = [];
        $finder = new PersonBirthdateDifferenceFinder($list);

        $result = $finder->find(Difference::CLOSEST);

        $this->assertEquals(null, $result->getFirstPerson());
        $this->assertEquals(null, $result->getSecondPerson());
    }

    /** @test */
    public function should_return_empty_when_given_one_person()
    {
        $list   = [];
        $list[] = $this->sue;
        $finder = new PersonBirthdateDifferenceFinder($list);

        $result = $finder->find(Difference::CLOSEST);

        $this->assertEquals(null, $result->getFirstPerson());
        $this->assertEquals(null, $result->getSecondPerson());
    }

    /** @test */
    public function should_return_closest_two_for_two_people()
    {
        $list   = [];
        $list[] = $this->sue;
        $list[] = $this->greg;
        $finder = new PersonBirthdateDifferenceFinder($list);

        $result = $finder->find(Difference::CLOSEST);

        $this->assertEquals($this->sue, $result->getFirstPerson());
        $this->assertEquals($this->greg, $result->getSecondPerson());
    }

    /** @test */
    public function should_return_furthest_two_for_two_people()
    {
        $list   = [];
        $list[] = $this->mike;
        $list[] = $this->greg;
        $finder = new PersonBirthdateDifferenceFinder($list);

        $result = $finder->find(Difference::FURTHEST);

        $this->assertEquals($this->greg, $result->getFirstPerson());
        $this->assertEquals($this->mike, $result->getSecondPerson());
    }

    /** @test */
    public function should_return_furthest_two_for_four_people()
    {
        $list   = [];
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
     * @test
     */
    public function should_return_closest_two_for_four_people()
    {
        $list   = [];
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
