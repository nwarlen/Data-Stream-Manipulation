<?php

namespace test\Streams\Operation;

require_once __DIR__ . '/../../../src/Streams/Operation/Maximum.php';


use Streams\Data\Point;
use Streams\Data\Stream;
use Streams\Operation\Maximum;

class MaximumTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @param $point1
     * @param $point2
     *
     * @dataProvider pointProvider
     */
    public function testItShouldMaximizeTwoValidStreams($point1, $point2)
    {
        $stream1 = new Stream(0,1);
        $stream2 = new Stream(0,1);


        $stream1->addPoint($point1); //smallPoint value: 5
        $stream2->addPoint($point2); //largePoint value: 20


        $maximum = new Maximum();

        /** @var $newStream Stream */
        $newStream = $maximum->combine($stream1, $stream2);

        /** @var $actual Point */
        $actual = $newStream->getPoints()[0];

        $newPoint = new Point();
        $newPoint->setValue(20);


        $this->assertEquals($newPoint->getValue(),$actual->getValue());
    }

    /**
     * @param $point1
     *
     * @dataProvider pointProvider
     */
    public function testItShouldMaximizeTwoValidStreamsWithZeros($point1)
    {
        $stream1 = new Stream(0,1);
        $stream2 = new Stream(0,1);

        $point3 = new Point();
        $point3->setValue(0);

        $stream1->addPoint($point1); //smallPoint value: 5
        $stream2->addPoint($point3); //largePoint value: 0


        $maximum = new Maximum();

        /** @var $newStream Stream */
        $newStream = $maximum->combine($stream1, $stream2);

        /** @var $actual Point */
        $actual = $newStream->getPoints()[0];

        $newPoint = new Point();
        $newPoint->setValue(5);

        $this->assertEquals($newPoint->getValue(),$actual->getValue());
    }

    /**
     * @param Point $point
     *
     * @dataProvider pointProvider
     */
    public function testItShouldNotMaximizeTwoStreamsThatAreNotCompatible(Point $point)
    {
        $stream1 = new Stream(1,2);
        $stream2 = new Stream(2,4);

        $stream1->addPoint($point);
        $stream2->addPoint($point);

        $maximum = new Maximum();

        $returnStream = $maximum->combine($stream1,$stream2);

        $this->assertNull($returnStream);
    }

    /**
     * @param $point
     *
     * @dataProvider pointProvider
     */
    public function testItShouldHandleNullPoints($point)
    {
        $stream1 = new Stream();
        $stream2 = new Stream();

        $nullPoint = new Point();
        $nullPoint->setValue(null);

        $stream1->addPoint($point); //value: 5
        $stream2->addPoint($nullPoint); //value: null

        $maximum = new Maximum();
        $returnStream = $maximum->combine($stream1,$stream2);


        $actual = $returnStream->getPoints()[0];

        $newPoint = new Point();
        $newPoint->setValue(5);

        $this->assertEquals($newPoint->getValue(),$actual->getValue());

        $returnStream = $maximum->combine($stream2,$stream1);
        $actual = $returnStream->getPoints()[0];

        $this->assertEquals($newPoint->getValue(),$actual->getValue());
    }

    public function pointProvider()
    {
        $smallPoint = new Point();
        $largePoint = new Point();
        $smallPoint->setValue(5);
        $largePoint->setValue(20);
        return array(
            array(
                $smallPoint,
                $largePoint
            )
        );
    }
}
 