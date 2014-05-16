<?php
/**
 * Created by PhpStorm.
 * User: nwarlen
 * Date: 5/16/14
 * Time: 9:09 AM
 */

namespace test\Streams\Operation;

require_once __DIR__ . '/../../../src/Streams/Operation/ValidStreams.php';

use Streams\Data\Stream;
use Streams\Operation\ValidStreams;

class ValidStreamsTest extends \PHPUnit_Framework_TestCase
{

    public function testItShouldRecognizeValidStreams()
    {
        $stream1 = new Stream();
        $stream2 = new Stream();

        $validityCheck = new ValidStreams();

        $isValid = $validityCheck->isValid($stream1,$stream2);

        $this->assertTrue($isValid);
    }
}
 