<?php

/**
 * This file is part of plumphp/plum.
 *
 * (c) Florian Eckerstorfer <florian@eckerstorfer.co>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Plum\Plum\Reader;

/**
 * ReaderFactoryTest
 *
 * @package   Plum\Plum\Reader
 * @author    Florian Eckerstorfer <florian@eckerstorfer.co>
 * @copyright 2015 Florian Eckerstorfer
 * @group     unit
 */
class ReaderFactoryTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var ReaderFactory
     */
    private $factory;

    public function setUp()
    {
        $this->factory = new ReaderFactory();
    }

    /**
     * @test
     * @covers Plum\Plum\Reader\ReaderFactory::addReader()
     * @covers Plum\Plum\Reader\ReaderFactory::create()
     * @covers Plum\Plum\Reader\ReaderFactory::createInstance()
     */
    public function createCreatesReaderBasedOnAddedReaders()
    {
        $this->factory->addReader('Plum\Plum\Reader\ArrayReader');

        $this->assertInstanceOf('Plum\Plum\Reader\ArrayReader', $this->factory->create(['foo']));
    }

    /**
     * @test
     * @covers                   Plum\Plum\Reader\ReaderFactory::addReader()
     * @covers                   Plum\Plum\Reader\ReaderFactory::create()
     * @covers                   Plum\Plum\Reader\ReaderFactory::createInstance()
     * @expectedException        \RuntimeException
     * @expectedExceptionMessage does not implement
     */
    public function createThrowsAnExceptionIfReaderDoesNotImplementInterface()
    {
        require_once __DIR__ . '/fixtures/ReaderFactoryTest.php';
        $this->factory->addReader('Plum\Plum\Reader\InvalidReader');

        $this->factory->create(['foo']);
    }

    /**
     * @test
     * @covers Plum\Plum\Reader\ReaderFactory::create()
     */
    public function createReturnsNullIfNoMatchingReader()
    {
        $this->factory->addReader('Plum\Plum\Reader\ArrayReader');

        $this->assertNull($this->factory->create('foo'));
    }
}