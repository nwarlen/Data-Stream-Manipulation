<?php
/**
 * Created by PhpStorm.
 * User: nwarlen
 * Date: 5/16/14
 * Time: 9:09 AM
 */

namespace Streams\Operation;

use Streams\Data\Stream;

class StreamValidator
{
    /**
     * isValid()
     *
     * Description: Compares stream1 to stream2, checking two conditions:
     *      1. Basis Time
     *      2. Interval Time
     *
     * @param Stream $stream1
     * @param Stream $stream2
     * @return bool - True if both conditions are equal for both streams
     *                --OR-- False if not
     */
    public function isValid(Stream $stream1, Stream $stream2)
    {
        //valid combinations must have same interval time, basis time
        if($stream1->getBasis() != $stream2->getBasis()) {
            return false;
        }

        if($stream1->getInterval() != $stream2->getInterval()) {
            return false;
        }

        return true;
    }
} 