<?php
/**
 * Created by PhpStorm.
 * User: nwarlen
 * Date: 5/15/14
 * Time: 11:14 AM
 */

namespace Streams\Data;

class Stream
{
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