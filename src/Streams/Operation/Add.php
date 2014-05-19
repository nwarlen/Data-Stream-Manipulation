<?php

namespace Streams\Operation;

require_once __DIR__ . '/StreamOperationInterface.php';
require_once __DIR__ . '/Operation.php';



class Add extends Operation implements StreamOperationInterface
{
    /**
     * computePoint()
     *
     * Description: Adds two points together
     *
     * @param $point1
     * @param $point2
     */
    public function computePoint($point1, $point2)
    {
        return $point1 + $point2;
    }
} 