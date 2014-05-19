<?php

namespace test\Streams\Operation;

require_once __DIR__ . '/../../../src/Streams/Operation/Subtract.php';

use Streams\Data\Stream;
use Streams\Operation\Subtract;

class SubtractTest extends \PHPUnit_Framework_TestCase
{
    public function testItShouldSubtractTwoValidStreams()
    {
        $stream1 = new Stream(0,1);
        $stream2 = new Stream(0,1);

        $point = 10;

        $stream1->addPoint($point);
        $stream2->addPoint($point);


        $subtract = new Subtract();
        $newStream = $subtract->apply($stream1, $stream2);

        $array = iterator_to_array($newStream->getIterator());
        $actual = $array[0];

        $newPoint = 0;

        $this->assertEquals($newPoint,$actual);
    }

    public function testItShouldAverageTwoValidStreamsWithZeros()
    {
        $stream1 = new Stream(0,1);
        $stream2 = new Stream(0,1);

        $point1 = 10;
        $point3 = 0;

        $stream1->addPoint($point1); //smallPoint value: 10
        $stream2->addPoint($point3); //largePoint value: 0


        $subtract = new Subtract();

        /** @var $newStream Stream */
        $newStream = $subtract->apply($stream1, $stream2);

        $array = iterator_to_array($newStream->getIterator());
        $actual = $array[0];

        $newPoint = 10;

        $this->assertEquals($newPoint,$actual);
    }

    public function testItShouldHandleNullPoints()
    {
        $stream1 = new Stream();
        $stream2 = new Stream();

        $point = 10;
        $nullPoint = null;

        $stream1->addPoint($point); //value: 10
        $stream2->addPoint($nullPoint); //value: null

        $subtract = new Subtract();
        $newStream = $subtract->apply($stream1,$stream2);

        $array = iterator_to_array($newStream->getIterator());
        $actual = $array[0];

        $newPoint = 10;

        $this->assertEquals($newPoint,$actual);

        $newStream = $subtract->apply($stream2,$stream1);

        $array = iterator_to_array($newStream->getIterator());
        $actual = $array[0];

        $newPoint = -10;

        $this->assertEquals($newPoint,$actual);
    }
}
 