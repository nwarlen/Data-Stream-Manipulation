<?php

namespace test\Streams\Operation;

require_once __DIR__ . '/../../../src/Streams/Operation/Add.php';

use Streams\Data\Stream;
use Streams\Operation\Add;

class AddTest extends \PHPUnit_Framework_TestCase
{
    public function testItShouldAddTwoValidStreams()
    {
        $stream1 = new Stream(0,1);
        $stream2 = new Stream(0,1);

        $point = 10;

        $stream1->addPoint($point);
        $stream2->addPoint($point);


        $adder = new Add();
        $newStream = $adder->apply($stream1, $stream2);

        $array = iterator_to_array($newStream->getIterator());

        $actual = $array[0];

        $newPoint = 20;

        $this->assertEquals($newPoint,$actual);

        //CHECK DIFFERENT SIZED STREAMS
        $stream1->addPoint($point);
        $stream1->addPoint($point);

        $expectedSize = $newStream->getSize();

        $newStream = $adder->apply($stream1,$stream2);
        $actualSize = $newStream->getSize();

        $this->assertEquals($expectedSize,$actualSize);
    }

    public function testItShouldAddTwoValidStreamsWithZeros()
    {
        $stream1 = new Stream(0,1);
        $stream2 = new Stream(0,1);

        $point3 = 0;
        $point1 = 10;

        $stream1->addPoint($point1); //smallPoint value: 10
        $stream2->addPoint($point3); //largePoint value: 0

        $adder = new Add();

        /** @var $newStream Stream */
        $newStream = $adder->apply($stream1, $stream2);

        $array = iterator_to_array($newStream->getIterator());

        $actual = $array[0];

        $newPoint = 10;

        $this->assertEquals($newPoint,$actual);
    }

    public function testItShouldHandleNullPoints()
    {
        $stream1 = new Stream();
        $stream2 = new Stream();

        $nullPoint = null;
        $point = 10;

        $stream1->addPoint($point); //value: 10
        $stream2->addPoint($nullPoint); //value: null

        $adder = new Add();
        $newStream = $adder->apply($stream1,$stream2);

        $array = iterator_to_array($newStream->getIterator());
        $actual = $array[0];

        $newPoint = 10;

        $this->assertEquals($newPoint,$actual);

        $newStream = $adder->apply($stream2,$stream1);

        $array = iterator_to_array($newStream->getIterator());
        $actual = $array[0];

        $this->assertEquals($newPoint,$actual);
    }


    public function testItShouldNotAddTwoStreamsThatAreNotCompatible()
    {
        $stream1 = new Stream(1,2);
        $stream2 = new Stream(2,4);

        $point = 10;

        $stream1->addPoint($point);
        $stream2->addPoint($point);

        $adder = new Add();

        $returnStream = $adder->apply($stream1,$stream2);

        $this->assertNull($returnStream);
    }
}
 