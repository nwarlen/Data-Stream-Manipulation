<?php


namespace test\Streams\Operation;

require_once __DIR__ . '/../../../src/Streams/Operation/Divide.php';

use Streams\Data\Stream;
use Streams\Operation\Divide;

class DivideTest extends \PHPUnit_Framework_TestCase
{
    public function testItShouldDivideTwoValidStreams()
    {
        $stream1 = new Stream(0,1);
        $stream2 = new Stream(0,1);

        $point = 10;

        $stream1->addPoint($point); //value: 10
        $stream2->addPoint($point); //value: 10


        $divide = new Divide();
        $newStream = $divide->apply($stream1, $stream2);

        $array = iterator_to_array($newStream->getIterator());

        $actual = $array[0];

        $newPoint = 1;

        $this->assertEquals($newPoint,$actual);
    }

    public function testItShouldDivideTwoValidStreamsWithZeros()
    {
        $stream1 = new Stream(0,1);
        $stream2 = new Stream(0,1);

        $point1 = 5;
        $point3 = 0;

        $stream1->addPoint($point1); //smallPoint value: 5
        $stream2->addPoint($point3); //largePoint value: 0


        $divide = new Divide();

        /** @var $newStream Stream */
        $newStream = $divide->apply($stream1, $stream2);

        $array = iterator_to_array($newStream->getIterator());

        $actual = $array[0];

        $this->assertNull($actual);
    }

    public function testItShouldNotDivideTwoStreamsThatAreNotCompatible()
    {
        $stream1 = new Stream(1,2);
        $stream2 = new Stream(2,4);

        $point = 10;

        $stream1->addPoint($point);
        $stream2->addPoint($point);

        $divide = new Divide();

        $returnStream = $divide->apply($stream1,$stream2);

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

        $divide = new Divide();
        $newStream = $divide->apply($stream1,$stream2);

        $array = iterator_to_array($newStream->getIterator());

        $actual = $array[0];

        $this->assertNull($actual);

        $newStream = $divide->apply($stream2,$stream1);

        $array = iterator_to_array($newStream->getIterator());

        $actual = $array[0];

        $this->assertNull($actual);
    }
}
 