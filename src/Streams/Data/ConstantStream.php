<?php

namespace Streams\Data;


use ArrayIterator;
use IteratorAggregate;

class ConstantStream implements IteratorAggregate
{
    private $size = 0;
    private $points = [];
    private $basisTime;
    private $intervalTime;
    private $value;

    public function __construct($basisTime = 0, $intervalTime = 1, $value = 0)
    {
        $this->basisTime = $basisTime;
        $this->intervalTime = $intervalTime;
        $this->value = $value;
    }

    public function getIterator()
    {
        return new ArrayIterator($this->points);
    }

    public function addPoint()
    {
        $this->points[] = $this->value;
        $this->size++;
    }
} 