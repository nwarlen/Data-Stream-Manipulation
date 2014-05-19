<?php


namespace test\Streams\Data;

require_once __DIR__ . '/../../../src/Streams/Data/ConstantStream.php';
require_once __DIR__ . '/../../../src/Streams/Operation/Add.php';


use Streams\Data\ConstantStream;
use Streams\Operation\Add;

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

    public function testItShouldAllowForOperations()
    {
        $constStream1 = new ConstantStream(0,1,5);
        $constStream2 = new ConstantStream(0,1,10);

        for($i=0;$i<10;$i++) {
            $constStream1->addPoint();
            $constStream2->addPoint();
        }

        $adder = new Add();

        $newStream = $adder->apply($constStream1,$constStream2);

        foreach($newStream as $x) {
            $this->assertEquals($x,15);
        }
    }
}
 