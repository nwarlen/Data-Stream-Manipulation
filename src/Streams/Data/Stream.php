<?php

namespace Streams\Data;

use ArrayIterator;
use IteratorAggregate;

class Stream implements IteratorAggregate
{
    protected $points = [];
    protected $size = 0;
    protected $basisTime;
    protected $intervalTime;

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
    }

    public function getIterator()
    {
        return new ArrayIterator($this->points);
    }

    /**
     * addPoint()
     *
     * Description: Adds a given point to the Stream's list of points
     *
     * @param $point - Point to add
     */
    public function addPoint($point)
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
     * @param $point - Point to search for
     * @return int - Index of the point in the list
     */
    public function doesContainPoint($point)
    {
        if(($index = array_search($point,$this->points)) === False) {
            $index = null;
        }
        return $index;
    }

    /**
     * setPointAt()
     *
     * Description: Sets the value of the point at the given index to the
     *              desired value.
     *
     * @param $index - index of the point to update
     * @param $newValue - value to update the point to
     *
     * @return bool - Returns true if point has been updated --OR-- false if not
     */
    public function setPointAt($index, $newValue)
    {
        if($this->size > $index) {
            $this->points[$index] = $newValue;
            return true;
        }
        return false;
    }

    //------GETTERS & SETTERS-------//

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