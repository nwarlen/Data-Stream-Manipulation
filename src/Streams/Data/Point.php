<?php

namespace Streams\Data;


class Point {
    protected $value;


    public function getValue()
    {
        return $this->value;
    }

    public function setValue($value)
    {
        if($value !== null) {
            $this->value = $value;
        }
    }





} 