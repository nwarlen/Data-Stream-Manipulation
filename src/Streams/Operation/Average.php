<?php

namespace Streams\Operation;

require_once __DIR__ . '/StreamOperationInterface.php';

class Average extends Operation implements StreamOperationInterface
{
    public function computePoint($point1, $point2)
    {
        if($point1 === null) {
            $pointToAdd = $point2;
        }
        else if($point2 === null) {
            $pointToAdd = $point1;
        }
        else {
            $pointToAdd = ($point1 + $point2)/2;
        }

        return $pointToAdd;
    }
} 