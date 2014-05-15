<?php
/**
 * Created by PhpStorm.
 * User: nwarlen
 * Date: 5/15/14
 * Time: 11:14 AM
 */

namespace Streams\Data;

class Stream {
    private $points;
    private $basisTime;
    private $intervalTime;
    private $size;

    /**
     * construct()
     *
     * Description: Create a new Point
     *
     * @param int $basisTime
     * @param int $intervalTime
     */
    public function __construct($basisTime = 0, $intervalTime = 1)
    {
        $this->basisTime = $basisTime;
        $this->intervalTime = $intervalTime;
        $this->size = 0;
        $this->points = [];
    }

    /**
     * addPoint()
     *
     * Description: Adds a given point to the Stream's list of points
     *
     * @param Point $point - Point to add
     */
    public function addPoint(Point $point)
    {
        $this->points[] = $point;
        $this->size++;
    }

    /**
     * doesContainPoint()
     *
     * Description: Searches the Stream for a given point and returns
     *              the first index of the point, in the list of points
     *              --OR-- 'null' if the point is not in the list.
     *
     * @param point - Point to search for
     * @return int - Index of the point in the list
     */
    public function doesContainPoint(Point $point)
    {
        if(($index = array_search($point,$this->points)) === False) {
            $index = null;
        }
        return $index;
    }

    /**
     * add()
     *
     * Description: Given a Stream, attempts to add all values in 'this' Stream and the new Stream.
     *
     * Example: a->add(b) =>
     *           A     B     C
     *          |0|   |1|   |1|
     *          |1| + |2| = |3|
     *          |2|   |3|   |5|
     *
     * @param Stream $stream - Stream to be added
     * @return null|Stream - The resulting Stream --OR-- null if the two Streams cannot be
     *                       combined
     */
    public function add(Stream $stream)
    {
        if(!$this->isValid($stream)) {
            return null;
        }

        $newStream = new Stream();

        //find the stream with fewer points
        $numPoints = (($this->size) <= ($stream->size) ? $this->size : $stream->size);

        for($index = 0;$index < $numPoints;$index++) {
            $pointToAdd = new Point();
            $pointValue = ($this->getPoints()[$index]->getValue()) + ($stream->getPoints()[$index]->getValue());
            $pointToAdd->setValue($pointValue);
            $newStream->addPoint($pointToAdd);
        }

        return $newStream;
    }

    /**
     * subtract()
     *
     * Description: Given a Stream, attempts to subtract all values in the new Stream from 'this' Stream
     *
     * @param Stream $stream - Stream to subtract
     * @return null|Stream - The resulting Stream --OR-- null if the two Streams cannot be
     *                       combined
     */
    public function subtract(Stream $stream)
    {
        if(!$this->isValid($stream)) {
            return null;
        }

        $newStream = new Stream();

        //find the stream with fewer points
        $numPoints = (($this->size) <= ($stream->size) ? $this->size : $stream->size);

        for($index = 0;$index < $numPoints;$index++) {
            $pointToAdd = new Point();
            $pointValue = ($this->getPoints()[$index]->getValue()) - ($stream->getPoints()[$index]->getValue());
            $pointToAdd->setValue($pointValue);
            $newStream->addPoint($pointToAdd);
        }

        return $newStream;
    }

    /**
     * multiply()
     *
     * Description: Given a Stream, attempts to multiply all values in the new Stream and 'this' Stream
     *
     * @param Stream $stream - Stream to multiply by
     * @return null|Stream - The resulting Stream --OR-- null if the two Streams cannot be
     *                       combined
     */
    public function multiply(Stream $stream)
    {
        if(!$this->isValid($stream)) {
            return null;
        }

        $newStream = new Stream();

        //find the stream with fewer points
        $numPoints = (($this->size) <= ($stream->size) ? $this->size : $stream->size);

        for($index = 0;$index < $numPoints;$index++) {
            $pointToAdd = new Point();
            $pointValue = ($this->getPoints()[$index]->getValue()) * ($stream->getPoints()[$index]->getValue());
            $pointToAdd->setValue($pointValue);
            $newStream->addPoint($pointToAdd);
        }

        return $newStream;
    }

    /**
     * divide()
     *
     * Description: Given a Stream, attempts to divide all values in 'this' Stream by the values in the
     * new Stream
     *
     * @param Stream $stream - Stream to divide by
     * @return null|Stream - The resulting Stream --OR-- null if the two Streams cannot be
     *                       combined
     */
    public function divide(Stream $stream)
    {
        if(!$this->isValid($stream)) {
            return null;
        }

        $newStream = new Stream();

        //find the stream with fewer points
        $numPoints = (($this->size) <= ($stream->size) ? $this->size : $stream->size);

        for($index = 0;$index < $numPoints;$index++) {
            $pointToAdd = new Point();
            $pointValue = ($this->getPoints()[$index]->getValue()) / ($stream->getPoints()[$index]->getValue()) ;
            $pointToAdd->setValue($pointValue);
            $newStream->addPoint($pointToAdd);
        }

        return $newStream;
    }

    /**
     * isValid()
     *
     * Description: Compares 'this' Stream to the given Stream, checking two conditions:
     *      1. Basis Time
     *      2. Interval Time
     *
     * @param Stream $stream - Stream to compare
     * @return bool - True if both conditions are equal for both streams
     *                --OR-- False if not
     */
    public function isValid(Stream $stream)
    {
        //valid combinations must have same interval time, basis time
        $returnValue = $this->getBasis() == $stream->getBasis();
        $returnValue = $returnValue && $this->getInterval() == $stream->getInterval();
        return $returnValue;
    }

    //------GETTERS & SETTERS-------//

    public function getPoints()
    {
        return $this->points;
    }

    public function getBasis()
    {
        return $this->basisTime;
    }

    public function getInterval()
    {
        return $this->intervalTime;
    }

    public function getSize()
    {
        return $this->size;
    }
} 