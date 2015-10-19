<?php

namespace Plum\Plum\Pipe;

use Mockery;
use PHPUnit_Framework_TestCase;

/**
 * FilterPipeTest
 *
 * @package   Plum\Plum\Pipe
 * @author    Florian Eckerstorfer
 * @copyright 2015 Florian Eckerstorfer
 * @group     unit
 */
class FilterPipeTest extends PHPUnit_Framework_TestCase
{
    /**
     * @test
     * @covers Plum\Plum\Pipe\FilterPipe::createFilter()
     * @covers Plum\Plum\Pipe\Pipe::getFilter()
     * @covers Plum\Plum\Pipe\Pipe::getType()
     */
    public function createFilterTakesFilterInterface()
    {
        /** @var \Plum\Plum\Filter\FilterInterface $filter */
        $filter = Mockery::mock('\Plum\Plum\Filter\FilterInterface');
        $pipe   = FilterPipe::createFilter($filter);

        $this->assertInstanceOf('\Plum\Plum\Pipe\FilterPipe', $pipe);
        $this->assertEquals($filter, $pipe->getFilter());
        $this->assertEquals(Pipe::PIPELINE_TYPE_FILTER, $pipe->getType());
    }

    /**
     * @test
     * @covers Plum\Plum\Pipe\FilterPipe::createFilter()
     */
    public function createFilterTakesCallbackFilter()
    {
        $filter = function ($v) { return true; };
        $pipe   = FilterPipe::createFilter($filter);

        $this->assertInstanceOf('\Plum\Plum\Pipe\FilterPipe', $pipe);
        $this->assertInstanceOf('\Plum\Plum\Filter\CallbackFilter', $pipe->getFilter());
    }

    /**
     * @test
     * @covers Plum\Plum\Pipe\FilterPipe::createFilter()
     * @covers Plum\Plum\Pipe\Pipe::getFilter()
     */
    public function createFilterTakesFilterInterfaceInArray()
    {
        /** @var \Plum\Plum\Filter\FilterInterface $filter */
        $filter = Mockery::mock('\Plum\Plum\Filter\FilterInterface');
        $pipe   = FilterPipe::createFilter(['filter' => $filter]);

        $this->assertInstanceOf('\Plum\Plum\Pipe\FilterPipe', $pipe);
        $this->assertEquals($filter, $pipe->getFilter());
    }

    /**
     * @test
     * @covers Plum\Plum\Pipe\FilterPipe::createFilter()
     */
    public function createFilterTakesCallbackFilterInArray()
    {
        $filter = function ($v) { return true; };
        $pipe   = FilterPipe::createFilter(['filter' => $filter]);

        $this->assertInstanceOf('\Plum\Plum\Pipe\FilterPipe', $pipe);
        $this->assertInstanceOf('\Plum\Plum\Filter\CallbackFilter', $pipe->getFilter());
    }

    /**
     * @test
     * @covers Plum\Plum\Pipe\FilterPipe::createFilter()
     * @expectedException \InvalidArgumentException
     */
    public function createFilterThrowsExceptionIfNoFilterGiven()
    {
        FilterPipe::createFilter('invalid');
    }

    /**
     * @test
     * @covers Plum\Plum\Pipe\FilterPipe::createFilter()
     * @expectedException \InvalidArgumentException
     */
    public function createFilterThrowsExceptionIfNoFilterGivenInArray()
    {
        FilterPipe::createFilter(['filter' => 'invalid']);
    }

    /**
     * @test
     * @covers Plum\Plum\Pipe\FilterPipe::createFilter()
     * @covers Plum\Plum\Pipe\Pipe::getFilter()
     * @covers Plum\Plum\Pipe\Pipe::setField()
     * @covers Plum\Plum\Pipe\Pipe::getField()
     * @covers Plum\Plum\Pipe\Pipe::setType()
     * @covers Plum\Plum\Pipe\Pipe::getType()
     */
    public function createFilterTakesFieldInArray()
    {
        /** @var \Plum\Plum\Filter\FilterInterface $filter */
        $filter = Mockery::mock('\Plum\Plum\Filter\FilterInterface');
        $pipe   = FilterPipe::createFilter(['filter' => $filter, 'field' => 'foo']);

        $this->assertInstanceOf('\Plum\Plum\Pipe\FilterPipe', $pipe);
        $this->assertEquals('foo', $pipe->getField());
        $this->assertEquals(Pipe::PIPELINE_TYPE_VALUE_FILTER, $pipe->getType());
    }
}