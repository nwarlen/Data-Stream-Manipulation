<?php

namespace Streams\Operation;


use Streams\Data\Point;
use Streams\Data\Stream;

class Add
{
    private $validityCheck;

    public function __construct()
    {
        $this->validityCheck = new ValidStreams();
    }


    /**
     * combine()
     *
     * Description: Given a Stream, attempts to add all values in 'this' Stream and the new Stream.
     *
     * Example: Add $C = $add->combine(a,b) =>
     *           A     B     C
     *          |0|   |1|   |1|
     *          |1| + |2| = |3|
     *          |2|   |3|   |5|
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
            $pointValue = ($stream1->getPoints()[$index]->getValue()) + ($stream2->getPoints()[$index]->getValue());
            $pointToAdd->setValue($pointValue);
            $newStream->addPoint($pointToAdd);
        }

        return $newStream;
    }
} 