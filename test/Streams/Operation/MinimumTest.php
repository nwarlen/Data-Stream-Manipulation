<?php

namespace test\Streams\Operation;

require_once __DIR__ . '/../../../src/Streams/Operation/Minimum.php';

use Streams\Data\Stream;
use Streams\Operation\Minimum;

class MinimumTest extends \PHPUnit_Framework_TestCase
{

    public function testItShouldMinimizeTwoValidStreams()
    {
        $stream1 = new Stream(0,1);
        $stream2 = new Stream(0,1);

        $point1 = 5;
        $point2 = 20;

        $stream1->addPoint($point1); //smallPoint value: 5
        $stream2->addPoint($point2); //largePoint value: 20


        $minimum = new Minimum();

        /** @var $newStream Stream */
        $newStream = $minimum->apply($stream1, $stream2);

        $array = iterator_to_array($newStream->getIterator());
        $actual = $array[0];

        $newPoint = 5;

        $this->assertEquals($newPoint,$actual);
    }

    public function testItShouldMinimizeTwoValidStreamsWithZeros()
    {
        $stream1 = new Stream(0,1);
        $stream2 = new Stream(0,1);

        $point1 = 5;
        $point3 = 0;

        $stream1->addPoint($point1); //smallPoint value: 5
        $stream2->addPoint($point3); //largePoint value: 0


        $minimum = new Minimum();

        /** @var $newStream Stream */
        $newStream = $minimum->apply($stream1, $stream2);

        $array = iterator_to_array($newStream->getIterator());
        $actual = $array[0];

        $newPoint = 0;

        $this->assertEquals($newPoint,$actual);
    }

    public function testItShouldNotMinimizeTwoStreamsThatAreNotCompatible()
    {
        $stream1 = new Stream(1,2);
        $stream2 = new Stream(2,4);

        $point = 5;

        $stream1->addPoint($point);
        $stream2->addPoint($point);

        $minimum = new Minimum();

        $returnStream = $minimum->apply($stream1,$stream2);

        $this->assertNull($returnStream);
    }

    public function testItShouldHandleNullPoints()
    {
        $stream1 = new Stream();
        $stream2 = new Stream();

        $point = 5;
        $nullPoint = null;

        $stream1->addPoint($point); //value: 5
        $stream2->addPoint($nullPoint); //value: null

        $minimum = new Minimum();
        $newStream = $minimum->apply($stream1,$stream2);

        $array = iterator_to_array($newStream->getIterator());
        $actual = $array[0];

        $newPoint = 5;

        $this->assertEquals($newPoint,$actual);

        $newStream = $minimum->apply($stream2,$stream1);

        $array = iterator_to_array($newStream->getIterator());
        $actual = $array[0];

        $this->assertEquals($newPoint,$actual);
    }
}