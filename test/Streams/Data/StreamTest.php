<?php

namespace test\Streams\Data;

require_once __DIR__ . '/../../../src/Streams/Data/Stream.php';


use PHPUnit_Framework_TestCase;
use Streams\Data\Point;
use Streams\Data\Stream;


class StreamTest extends PHPUnit_Framework_TestCase {

    /**
     * @param $point
     *
     * @dataProvider pointProvider
     */
    public function testItShouldAddPoints($point)
    {
        $stream = new Stream();
        $size = $stream->getSize();
        $stream->addPoint($point);
        $sizeAfterAddingPoint = $stream->getSize();

        $this->assertTrue($size+1==$sizeAfterAddingPoint);

        $nullPoint = new Point();
        $nullPoint->setValue(null);
        $stream->addPoint($nullPoint);
        $sizeAfterAddingPoint = $stream->getSize();

        $this->assertTrue($size+2 ==$sizeAfterAddingPoint);
    }

    /**
     * @param Point $point
     *
     * @dataProvider pointProvider
     */
    public function testItShouldFindAGivenPointInTheListOfPoints(Point $point)
    {
        $stream = new Stream();
        $stream->addPoint($point);

        $index = $stream->doesContainPoint($point);

        $expected = 0;

        $this->assertEquals($expected,$index);

        $invalidPoint = new Point();
        $invalidPoint->setValue(12);

        //Searching for an invalid point returns null
        $index = $stream->doesContainPoint($invalidPoint);

        $this->assertNull($index);
    }

    /**
     * @return array - Point $point
     */
    public function pointProvider()
    {
        $point = new Point();
        $point->setValue(10);

        return array (
            array(
                $point
            )
        );
    }
}