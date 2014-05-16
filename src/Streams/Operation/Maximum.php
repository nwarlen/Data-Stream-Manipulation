<?php

namespace Streams\Operation;


use Streams\Data\Point;
use Streams\Data\Stream;

class Maximum
{
    private $validityCheck;

    public function __construct()
    {
        $this->validityCheck = new ValidStreams();
    }

    /**
     * combine()
     *
     * Description: Attempts to create a new Stream with the largest value at each index
     *              from stream1 and stream2
     *
     * Example: Maximum: $C = $max->combine(a,b) =>
     *           A     B     C
     *          |0|   |1|   |1|
     *          |1| + |2| = |3|
     *          |2|   |0|   |2|
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
            $pointValue = max($stream1->getPoints()[$index]->getValue() , $stream2->getPoints()[$index]->getValue());
            $pointToAdd->setValue($pointValue);
            $newStream->addPoint($pointToAdd);
        }

        return $newStream;
    }
} 