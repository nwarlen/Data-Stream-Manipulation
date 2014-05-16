<?php

namespace test\Streams\Data;

require_once __DIR__ . '/../../../src/Streams/Data/Point.php';

use PHPUnit_Framework_TestCase;
use Streams\Data\Point;


class PointTest extends PHPUnit_Framework_TestCase {

    /**
     * @param $value
     * @param $nullValue
     *
     * @dataProvider valueProvider
     */
    public function testItShouldUpdateAPointsValue($value,$nullValue)
    {
        $point = new Point();
        $point->setValue($value);

        $expected = $value;

        $actual = $point->getValue();

        $this->assertEquals($expected,$actual);

        $point->setValue($nullValue);

        $actual = $point->getValue();

        $this->assertNull($actual);
    }

    public function valueProvider()
    {
        return array(
            array(
                10,
                null
            )
        );
    }
}
 