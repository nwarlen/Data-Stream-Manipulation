<?php

namespace test\Streams\Data;

require_once __DIR__ . '/../../../src/Streams/Data/Stream.php';


use PHPUnit_Framework_TestCase;
use Streams\Data\Stream;

class StreamTest extends PHPUnit_Framework_TestCase
{
    public function testItShouldAddPoints()
    {
        $point = 10;
        $stream = new Stream();

        $size = $stream->getSize();

        $stream->addPoint($point);

        $sizeAfterAddingPoint = $stream->getSize();

        $this->assertTrue($size+1==$sizeAfterAddingPoint);

        $nullPoint = null;
        $stream->addPoint($nullPoint);
        $sizeAfterAddingPoint = $stream->getSize();

        $this->assertTrue($size+2 ==$sizeAfterAddingPoint);
    }

    public function testItShouldFindAGivenPointInTheListOfPoints()
    {
        $point = 10;

        $stream = new Stream();
        $stream->addPoint($point);

        $index = $stream->doesContainPoint($point);

        $expected = 0;

        $this->assertEquals($expected,$index);

        $invalidPoint = 12;

        //Searching for an invalid point returns null
        $index = $stream->doesContainPoint($invalidPoint);

        $this->assertNull($index);
    }

    public function testItShouldUpdateAPointThatIsAvailable()
    {
        $stream = new Stream();
        $point = 10;

        $stream->addPoint($point);
        $stream->addPoint($point);

        $index = 0;
        $newValue = 5;

        $bool = $stream->setPointAt($index,$newValue);

        $expected = 5;

        $actual = iterator_to_array($stream->getIterator())[0];

        $this->assertTrue($bool);
        $this->assertEquals($expected,$actual);
    }

    public function testItShouldNotUpdateAPointThatIsNotAvailable()
    {
        $stream = new Stream();
        $point = 10;

        $stream->addPoint($point);
        $stream->addPoint($point);

        $index = 2;
        $newValue = 5;

        $bool = $stream->setPointAt($index,$newValue);

        $this->assertFalse($bool);
    }
}