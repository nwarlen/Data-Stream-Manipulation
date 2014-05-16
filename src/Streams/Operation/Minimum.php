<?php
/**
 * Created by PhpStorm.
 * User: nwarlen
 * Date: 5/16/14
 * Time: 10:15 AM
 */

namespace Streams\Operation;


use Streams\Data\Point;
use Streams\Data\Stream;

class Minimum
{
    private $validityCheck;

    public function __construct()
    {
        $this->validityCheck = new ValidStreams();
    }

    /**
     * combine()
     *
     * Description: Attempts to create a new Stream with the smallest value at each index
     *              from stream1 and stream2
     *
     * Example: Minimum: $C = $min->combine(a,b) =>
     *           A     B     C
     *          |0|   |1|   |0|
     *          |1| + |2| = |1|
     *          |2|   |0|   |0|
     *
     * @param Stream $stream1
     * @param Stream $stream2
     * @return null|Stream - The resulting Stream --OR-- null if the two Streams cannot be
     *                       combined
     */
    public function combine(Stream $stream1, Stream $stream2)
    {
        if(!($this->validityCheck->isValid($stream1,$stream2))) {
            return null;
        }

        $newStream = new Stream();

        //find the stream with fewer points
        $numPoints = (($stream1->getSize()) <= ($stream2->getSize()) ? $stream1->getSize() : $stream2->getSize());

        for($index = 0;$index < $numPoints;$index++) {
            $pointToAdd = new Point();
            $pointValue = min($stream1->getPoints()[$index]->getValue() , $stream2->getPoints()[$index]->getValue());
            $pointToAdd->setValue($pointValue);
            $newStream->addPoint($pointToAdd);
        }

        return $newStream;
    }
} 