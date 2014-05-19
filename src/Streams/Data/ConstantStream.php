<?php

namespace Streams\Data;

require_once __DIR__ . '/Stream.php';

use ArrayIterator;
use IteratorAggregate;


class ConstantStream extends Stream implements IteratorAggregate
{
    private $value;

    public function __construct($basisTime = 0, $intervalTime = 1, $value = 0)
    {
        $this->basisTime = $basisTime;
        $this->intervalTime = $intervalTime;
        $this->value = $value;
    }

    public function addPoint()
    {
        $this->points[] = $this->value;
        $this->size++;
    }

    public function getIterator()
    {
        return new ArrayIterator($this->points);
    }
} 