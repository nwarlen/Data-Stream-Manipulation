<?php

namespace Streams\Operation;

require_once __DIR__ . '/StreamOperationInterface.php';


class Multiply extends Operation implements StreamOperationInterface
{
    public function computePoint($point1, $point2)
    {
        return $point1 * $point2;
    }
} 