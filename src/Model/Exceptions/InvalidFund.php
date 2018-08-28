<?php

declare(strict_types=1);

namespace ChrisHarrison\Portfolio\Model\Exceptions;

use Exception;

final class InvalidFund extends Exception
{
    public function __construct(string $reason)
    {
        parent::__construct(sprintf('Invalid fund: %s', $reason));
    }
}
