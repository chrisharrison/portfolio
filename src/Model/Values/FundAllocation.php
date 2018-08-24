<?php

declare(strict_types=1);

namespace ChrisHarrison\Portfolio\Model\Values;

use ChrisHarrison\Portfolio\Model\Fund;

final class FundAllocation extends Allocation
{
    public function getTag(): Fund
    {
        return parent::getTag();
    }
}
