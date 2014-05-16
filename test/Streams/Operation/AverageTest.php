<?php

namespace test\Streams\Operation;

require_once __DIR__ . '/../../../src/Streams/Operation/Average.php';


use Streams\Data\Point;
use Streams\Data\Stream;
use Streams\Operation\Average;

class AverageTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @param $point1
     * @param $point2
     *
     * @dataProvider pointProvider
     */
    public function testItShouldAverageTwoValidStreams($point1, $point2)
    {
        $stream1 = new Stream(0,1);
        $stream2 = new Stream(0,1);


        $stream1->addPoint($point1); //smallPoint value: 5
        $stream2->addPoint($point2); //largePoint value: 20


        $average = new Average();

        /** @var $newStream Stream */
        $newStream = $average->combine($stream1, $stream2);

        /** @var $actual Point */
        $actual = $newStream->getPoints()[0];

        $newPoint = new Point();
        $newPoint->setValue(12.5);


        $this->assertEquals($newPoint->getValue(),$actual->getValue());
    }

    /**
     * @param Point $point
     *
     * @dataProvider pointProvider
     */
    public function testItShouldNotAverageTwoStreamsThatAreNotCompatible(Point $point)
    {
        $stream1 = new Stream(1,2);
        $stream2 = new Stream(2,4);

        $stream1->addPoint($point);
        $stream2->addPoint($point);

        $average = new Average();

        $returnStream = $average->combine($stream1,$stream2);

        $this->assertNull($returnStream);
    }

    public function pointProvider()
    {
        $smallPoint = new Point();
        $largePoint = new Point();
        $smallPoint->setValue(5);
        $largePoint->setValue(20);
        return array(
            array(
                $smallPoint,
                $largePoint
            )
        );
    }
}
 