<?php

declare(strict_types=1);

namespace ChrisHarrison\Portfolio\Model\Exceptions;

use Exception;

final class InvalidPortfolio extends Exception
{
    public function __construct(string $reason)
    {
        parent::__construct(sprintf('Invalid portfolio: %s', $reason));
    }
}
