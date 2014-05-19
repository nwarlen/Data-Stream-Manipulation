<?php

namespace Streams\Operation;

use Streams\Data\Stream;

interface StreamOperationInterface {
    public function apply(Stream $stream1, Stream $stream2);
} 