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
 