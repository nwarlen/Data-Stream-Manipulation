<?php

namespace Streams\Operation;

require_once __DIR__ . '/StreamOperationInterface.php';

class Divide extends Operation implements StreamOperationInterface
{
    public function computePoint($point1, $point2)
    {
        $pointToAdd = null;
        if($point2 != null) {
            $pointToAdd = ($point1) / ($point2);
        }

        if($point1 === null) {
            $pointToAdd = null;
        }

        return $pointToAdd;
    }
} 