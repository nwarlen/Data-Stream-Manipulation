<?php

namespace Streams\Operation;

require_once __DIR__ . '/StreamOperationInterface.php';

class Maximum extends Operation implements StreamOperationInterface
{
    public function computePoint($point1, $point2)
    {
        return max($point1,$point2);
    }
} 