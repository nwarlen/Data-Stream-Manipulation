<?php


namespace test\Streams\Data;

require_once __DIR__ . '/../../../src/Streams/Data/ConstantStream.php';

use Streams\Data\ConstantStream;

class ConstantStreamTest extends \PHPUnit_Framework_TestCase {
    public function testItShouldHaveConstantValues()
    {
        $constStream = new ConstantStream(0,1,5);

        for($i=0;$i<10;$i++) {
            $constStream->addPoint();
        }

        foreach($constStream as $i) {
            $this->assertEquals(5,$i);
        }
    }
}
 