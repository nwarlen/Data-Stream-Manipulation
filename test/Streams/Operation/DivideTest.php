<?php


namespace test\Streams\Operation;

require_once __DIR__ . '/../../../src/Streams/Operation/Divide.php';


use Streams\Data\Point;
use Streams\Data\Stream;
use Streams\Operation\Divide;

class DivideTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @param $point
     *
     * @dataProvider pointProvider
     */
    public function testItShouldDivideTwoValidStreams($point)
    {
        $stream1 = new Stream(0,1);
        $stream2 = new Stream(0,1);


        $stream1->addPoint($point); //value: 10
        $stream2->addPoint($point); //value: 10


        $divide = new Divide();
        $newStream = $divide->combine($stream1, $stream2);

        $actual = $newStream->getPoints()[0];

        $newPoint = new Point();
        $newPoint->setValue(1);


        $this->assertEquals($newPoint->getValue(),$actual->getValue());
    }

    /**
     * @param Point $point
     *
     * @dataProvider pointProvider
     */
    public function testItShouldNotDivideTwoStreamsThatAreNotCompatible(Point $point)
    {
        $stream1 = new Stream(1,2);
        $stream2 = new Stream(2,4);

        $stream1->addPoint($point);
        $stream2->addPoint($point);

        $divide = new Divide();

        $returnStream = $divide->combine($stream1,$stream2);

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

        $divide = new Divide();
        $returnStream = $divide->combine($stream1,$stream2);


        $actual = $returnStream->getPoints()[0];

        $newPoint = new Point();
        $newPoint->setValue(null);

        $this->assertEquals($newPoint->getValue(),$actual->getValue());

        $returnStream = $divide->combine($stream2,$stream1);
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
 