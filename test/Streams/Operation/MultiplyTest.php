<?php


namespace test\Streams\Operation;

require_once __DIR__ . '/../../../src/Streams/Operation/Multiply.php';

use Streams\Data\Point;
use Streams\Data\Stream;
use Streams\Operation\Multiply;

class MultiplyTest extends \PHPUnit_Framework_TestCase
{
    /**
    * @param $point
    *
    * @dataProvider pointProvider
    */
    public function testItShouldMultiplyTwoValidStreams($point)
    {
        $stream1 = new Stream(0,1);
        $stream2 = new Stream(0,1);


        $stream1->addPoint($point);
        $stream2->addPoint($point);


        $multiplier = new Multiply();
        $newStream = $multiplier->combine($stream1, $stream2);

        $actual = $newStream->getPoints()[0];

        $newPoint = new Point();
        $newPoint->setValue(100);


        $this->assertEquals($newPoint->getValue(),$actual->getValue());
    }

    /**
     * @param $point1
     *
     * @dataProvider pointProvider
     */
    public function testItShouldMultiplyTwoValidStreamsWithZeros($point1)
    {
        $stream1 = new Stream(0,1);
        $stream2 = new Stream(0,1);

        $point3 = new Point();
        $point3->setValue(0);

        $stream1->addPoint($point1); //smallPoint value: 5
        $stream2->addPoint($point3); //largePoint value: 0


        $multiply = new Multiply();

        /** @var $newStream Stream */
        $newStream = $multiply->combine($stream1, $stream2);

        /** @var $actual Point */
        $actual = $newStream->getPoints()[0];

        $newPoint = new Point();
        $newPoint->setValue(0);

        $this->assertEquals($newPoint->getValue(),$actual->getValue());
    }

    /**
     * @param Point $point
     *
     * @dataProvider pointProvider
     */
    public function testItShouldNotMultiplyTwoStreamsThatAreNotCompatible(Point $point)
    {
        $stream1 = new Stream(1,2);
        $stream2 = new Stream(2,4);

        $stream1->addPoint($point);
        $stream2->addPoint($point);

        $multiplier = new Multiply();

        $returnStream = $multiplier->combine($stream1,$stream2);

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

        $stream1->addPoint($point); //value: 10
        $stream2->addPoint($nullPoint); //value: null

        $multiply = new Multiply();
        $returnStream = $multiply->combine($stream1,$stream2);


        $actual = $returnStream->getPoints()[0];

        $newPoint = new Point();
        $newPoint->setValue(null);

        $this->assertEquals($newPoint->getValue(),$actual->getValue());

        $returnStream = $multiply->combine($stream2,$stream1);
        $actual = $returnStream->getPoints()[0];

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
 