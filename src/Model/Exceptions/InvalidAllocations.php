<?php

declare(strict_types=1);

namespace ChrisHarrison\Portfolio\Model\Exceptions;

use Exception;

final class InvalidAllocations extends Exception
{
    public function __construct(string $reason)
    {
        parent::__construct(sprintf('Invalid allocations: %s', $reason));
    }
}
