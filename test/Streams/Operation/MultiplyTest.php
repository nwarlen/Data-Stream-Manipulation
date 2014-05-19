<?php


namespace test\Streams\Operation;

require_once __DIR__ . '/../../../src/Streams/Operation/Multiply.php';

use Streams\Data\Stream;
use Streams\Operation\Multiply;

class MultiplyTest extends \PHPUnit_Framework_TestCase
{
    public function testItShouldMultiplyTwoValidStreams()
    {
        $stream1 = new Stream(0,1);
        $stream2 = new Stream(0,1);

        $point = 10;

        $stream1->addPoint($point);
        $stream2->addPoint($point);


        $multiplier = new Multiply();
        $newStream = $multiplier->apply($stream1, $stream2);

        $array = iterator_to_array($newStream->getIterator());
        $actual = $array[0];

        $newPoint = 100;

        $this->assertEquals($newPoint,$actual);
    }

    public function testItShouldMultiplyTwoValidStreamsWithZeros()
    {
        $stream1 = new Stream(0,1);
        $stream2 = new Stream(0,1);

        $point1 = 10;
        $point3 = 0;

        $stream1->addPoint($point1); //smallPoint value: 10
        $stream2->addPoint($point3); //largePoint value: 0


        $multiply = new Multiply();

        /** @var $newStream Stream */
        $newStream = $multiply->apply($stream1, $stream2);

        $array = iterator_to_array($newStream->getIterator());
        $actual = $array[0];

        $newPoint = 0;

        $this->assertEquals($newPoint,$actual);
    }

    public function testItShouldNotMultiplyTwoStreamsThatAreNotCompatible()
    {
        $stream1 = new Stream(1,2);
        $stream2 = new Stream(2,4);

        $point = 10;

        $stream1->addPoint($point);
        $stream2->addPoint($point);

        $multiplier = new Multiply();

        $returnStream = $multiplier->apply($stream1,$stream2);

        $this->assertNull($returnStream);
    }

    public function testItShouldHandleNullPoints()
    {
        $stream1 = new Stream();
        $stream2 = new Stream();

        $point = 10;
        $nullPoint = null;

        $stream1->addPoint($point); //value: 10
        $stream2->addPoint($nullPoint); //value: null

        $multiply = new Multiply();
        $newStream = $multiply->apply($stream1,$stream2);

        $array = iterator_to_array($newStream->getIterator());
        $actual = $array[0];

        $newPoint = null;

        $this->assertEquals($newPoint,$actual);

        $newStream = $multiply->apply($stream2,$stream1);

        $array = iterator_to_array($newStream->getIterator());
        $actual = $array[0];

        $this->assertEquals($newPoint,$actual);
    }
}
 