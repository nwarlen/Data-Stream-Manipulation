<?php


require_once __DIR__ . '/../../../src/Streams/Data/Stream.php';


use Streams\Data\Point;
use Streams\Data\Stream;

/**
 * Created by PhpStorm.
 * User: nwarlen
 * Date: 5/15/14
 * Time: 11:17 AM
 */

class StreamTest extends PHPUnit_Framework_TestCase {

    /**
     * @param $point
     *
     * @dataProvider pointProvider
     */
    public function testItShouldAddPoints($point)
    {
        $stream = new Stream();
        $size = $stream->getSize();
        $stream->addPoint($point);
        $sizeAfterAddingPoint = $stream->getSize();

        $this->assertTrue($size+1==$sizeAfterAddingPoint);
    }

    /**
     * @param Point $point
     *
     * @dataProvider pointProvider
     */
    public function testItShouldFindAGivenPointInTheListOfPoints(Point $point)
    {
        $stream = new Stream();
        $stream->addPoint($point);

        $index = $stream->doesContainPoint($point);

        $expected = 0;

        $this->assertEquals($expected,$index);

        $invalidPoint = new Point();
        $invalidPoint->setValue(12);

        //Searching for an invalid point returns null
        $index = $stream->doesContainPoint($invalidPoint);

        $this->assertNull($index);
    }

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


        /** @var $returnStream Stream */
        $returnStream = $stream1->add($stream2);

        /** @var $actual Point */
        $actual = $returnStream->getPoints()[0];

        $newPoint = new Point();
        $newPoint->setValue(20);


        $this->assertEquals($newPoint->getValue(),$actual->getValue());
    }

    /**
     * @param Point $point
     *
     * @dataProvider pointProvider
     */
    public function testItShouldSubtractTwoValidStreams(Point $point)
    {
        $stream1 = new Stream(0,1);
        $stream2 = new Stream(0,1);


        $stream1->addPoint($point);
        $stream2->addPoint($point);


        /** @var $returnStream Stream */
        $returnStream = $stream1->subtract($stream2);

        /** @var $actual Point */
        $actual = $returnStream->getPoints()[0];

        $newPoint = new Point();
        $newPoint->setValue(0);


        $this->assertEquals($newPoint->getValue(),$actual->getValue());
    }

    /**
     * @param Point $point
     *
     * @dataProvider pointProvider
     */
    public function testItShouldNotCombineTwoStreamsThatAreNotCompatible(Point $point)
    {
        $stream1 = new Stream(1,2);
        $stream2 = new Stream(2,4);

        $stream1->addPoint($point);
        $stream2->addPoint($point);

        $returnStream = $stream1->add($stream2);

        $this->assertNull($returnStream);
    }



    /**
     * @return array - Point $point
     */
    public function pointProvider()
    {
        $point = new Point();
        $point->setValue(10);

        return array (
            array(
                $point
            )
        );
    }

    /**
     * @return array - Stream $stream
     */
    public function streamProvider()
    {
        $stream = new Stream();

        return array(
            array(
                $stream
            )
        );
    }
}
 