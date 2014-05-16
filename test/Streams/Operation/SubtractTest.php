<?php

namespace test\Streams\Operation;

require_once __DIR__ . '/../../../src/Streams/Operation/Subtract.php';

use Streams\Data\Point;
use Streams\Data\Stream;
use Streams\Operation\Subtract;

class SubtractTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @param $point
     *
     * @dataProvider pointProvider
     */
    public function testItShouldSubtractTwoValidStreams($point)
    {
        $stream1 = new Stream(0,1);
        $stream2 = new Stream(0,1);


        $stream1->addPoint($point);
        $stream2->addPoint($point);


        $subtract = new Subtract();
        $newStream = $subtract->combine($stream1, $stream2);


        $actual = $newStream->getPoints()[0];

        $newPoint = new Point();
        $newPoint->setValue(0);


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
 