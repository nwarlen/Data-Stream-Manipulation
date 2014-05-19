<?php
/**
 * Created by PhpStorm.
 * User: nwarlen
 * Date: 5/19/14
 * Time: 10:15 AM
 */

namespace Streams\Operation;

use Streams\Data\Stream;

abstract class Operation implements StreamOperationInterface
{
    private $validityCheck;

    public function __construct()
    {
        $this->validityCheck = new StreamValidator();
    }

    abstract public function computePoint($point1,$point2);

    /**
     * apply()
     *
     * @param Stream $stream1
     * @param Stream $stream2
     *
     * @return null|Stream - The resulting Stream --OR-- null if the two Streams cannot be
     *                       combined
     */
    public function apply(Stream $stream1, Stream $stream2)
    {
        if(!($this->validityCheck->isValid($stream1,$stream2))) {
            return null;
        }

        $basis = $stream1->getBasis();
        $interval = $stream1->getInterval();
        $newStream = new Stream($basis,$interval);

        //find the stream with fewer points
        $numPoints = (($stream1->getSize()) <= ($stream2->getSize()) ? $stream1->getSize() : $stream2->getSize());

        $stream1Array = iterator_to_array($stream1->getIterator());
        $stream2Array = iterator_to_array($stream2->getIterator());

        for($index = 0;$index < $numPoints;$index++) {
            $point1 = $stream1Array[$index];
            $point2 = $stream2Array[$index];
            $newStream->addPoint($this->computePoint($point1,$point2));
        }
        return $newStream;
    }
} 