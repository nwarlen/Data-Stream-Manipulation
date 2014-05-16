<?php

namespace Streams\Operation;

use Streams\Data\Point;
use Streams\Data\Stream;

class Average
{
    private $validityCheck;

    public function __construct()
    {
        $this->validityCheck = new ValidStreams();
    }

    /**
     * combine()
     *
     * Description: Attempts to create a new Stream with the average value at each index
     *              from stream1 and stream2
     *
     * If a point from either stream is null the resulting stream at that index will be the non-null point.
     *
     * Example: Average: $C = $avg->combine(a,b) =>
     *           A     B     C
     *          |0|   |1|   |0.5|
     *          |1| + |2| = |1.5|
     *          |2|   |0|   |1.0|
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

        $basis = $stream1->getBasis();
        $interval = $stream1->getInterval();
        $newStream = new Stream($basis,$interval);

        //find the stream with fewer points
        $numPoints = (($stream1->getSize()) <= ($stream2->getSize()) ? $stream1->getSize() : $stream2->getSize());

        for($index = 0;$index < $numPoints;$index++) {
            $pointToAdd = new Point();
            $pointValue = ($stream1->getPoints()[$index]->getValue() + $stream2->getPoints()[$index]->getValue())/2;
            $pointToAdd->setValue($pointValue);
            $newStream->addPoint($pointToAdd);
        }

        return $newStream;
    }
} 