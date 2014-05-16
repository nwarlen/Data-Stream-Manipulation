<?php


namespace test\Streams\Operation;

require_once __DIR__ . '/../../../src/Streams/Operation/Add.php';

use Streams\Data\Point;
use Streams\Data\Stream;
use Streams\Operation\Add;

class AddTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @param $point
     *
     * @dataProvider pointProvider
     */
    public function testItShouldAddTwoValidStreams($point)
    {
        $stream1 = new Stream(0,1);
        $stream2 = new Stream(0,1);


        $stream1->addPoint($point);
        $stream2->addPoint($point);


        $adder = new Add();
        $newStream = $adder->combine($stream1, $stream2);

        $actual = $newStream->getPoints()[0];

        $newPoint = new Point();
        $newPoint->setValue(20);


        $this->assertEquals($newPoint->getValue(),$actual->getValue());


        //CHECK DIFFERENT SIZED STREAMS
        $stream1->addPoint($point);
        $stream1->addPoint($point);

        $expectedSize = $newStream->getSize();

        $newStream = $adder->combine($stream1,$stream2);
        $actualSize = $newStream->getSize();

        $this->assertEquals($expectedSize,$actualSize);
    }

    /**
     * @param $point1
     *
     * @dataProvider pointProvider
     */
    public function testItShouldAddTwoValidStreamsWithZeros($point1)
    {
        $stream1 = new Stream(0,1);
        $stream2 = new Stream(0,1);

        $point3 = new Point();
        $point3->setValue(0);

        $stream1->addPoint($point1); //smallPoint value: 10
        $stream2->addPoint($point3); //largePoint value: 0


        $adder = new Add();

        /** @var $newStream Stream */
        $newStream = $adder->combine($stream1, $stream2);

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

        $adder = new Add();
        $returnStream = $adder->combine($stream1,$stream2);


        $actual = $returnStream->getPoints()[0];

        $newPoint = new Point();
        $newPoint->setValue(10);

        $this->assertEquals($newPoint->getValue(),$actual->getValue());

        $returnStream = $adder->combine($stream2,$stream1);
        $actual = $returnStream->getPoints()[0];

        $this->assertEquals($newPoint->getValue(),$actual->getValue());
    }

    /**
     * @param Point $point
     *
     * @dataProvider pointProvider
     */
    public function testItShouldNotAddTwoStreamsThatAreNotCompatible(Point $point)
    {
        $stream1 = new Stream(1,2);
        $stream2 = new Stream(2,4);

        $stream1->addPoint($point);
        $stream2->addPoint($point);

        $adder = new Add();

        $returnStream = $adder->combine($stream1,$stream2);

        $this->assertNull($returnStream);
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
 