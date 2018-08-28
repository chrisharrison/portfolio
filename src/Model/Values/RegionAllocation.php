<?php

declare(strict_types=1);

namespace ChrisHarrison\Portfolio\Model\Values;

final class RegionAllocation extends Allocation
{
    public function __construct(Region $tag, float $value)
    {
        parent::__construct($tag, $value);
    }

    public function getTag(): Region
    {
        return parent::getTag();
    }
}
