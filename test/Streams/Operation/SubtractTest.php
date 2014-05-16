<?php

namespace test\Streams\Operation;

require_once __DIR__ . '/../../../src/Streams/Operation/Subtract.php';

use Streams\Data\Point;
use Streams\Data\Stream;
use Streams\Operation\Subtract;

class SubtractTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @param $point
     *
     * @dataProvider pointProvider
     */
    public function testItShouldSubtractTwoValidStreams($point)
    {
        $stream1 = new Stream(0,1);
        $stream2 = new Stream(0,1);


        $stream1->addPoint($point);
        $stream2->addPoint($point);


        $subtract = new Subtract();
        $newStream = $subtract->combine($stream1, $stream2);


        $actual = $newStream->getPoints()[0];

        $newPoint = new Point();
        $newPoint->setValue(0);


        $this->assertEquals($newPoint->getValue(),$actual->getValue());
    }

    /**
     * @param $point1
     *
     * @dataProvider pointProvider
     */
    public function testItShouldAverageTwoValidStreamsWithZeros($point1)
    {
        $stream1 = new Stream(0,1);
        $stream2 = new Stream(0,1);

        $point3 = new Point();
        $point3->setValue(0);

        $stream1->addPoint($point1); //smallPoint value: 10
        $stream2->addPoint($point3); //largePoint value: 0


        $subtract = new Subtract();

        /** @var $newStream Stream */
        $newStream = $subtract->combine($stream1, $stream2);

        /** @var $actual Point */
        $actual = $newStream->getPoints()[0];

        $newPoint = new Point();
        $newPoint->setValue(10);

        $this->assertEquals($newPoint->getValue(),$actual->getValue());
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

        $stream1->addPoint($point); //value: 10
        $stream2->addPoint($nullPoint); //value: null

        $subtract = new Subtract();
        $returnStream = $subtract->combine($stream1,$stream2);


        $actual = $returnStream->getPoints()[0];

        $newPoint = new Point();
        $newPoint->setValue(10);

        $this->assertEquals($newPoint->getValue(),$actual->getValue());

        $returnStream = $subtract->combine($stream2,$stream1);
        $actual = $returnStream->getPoints()[0];

        $newPoint->setValue(-10);

        $this->assertEquals($newPoint->getValue(),$actual->getValue());
    }

    public function pointProvider()
    {
        $point = new Point();
        $point->setValue(10);
        return array(
            array(
                $point
            )
        );
    }
}
 