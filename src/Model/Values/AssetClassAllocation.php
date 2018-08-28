<?php

declare(strict_types=1);

namespace ChrisHarrison\Portfolio\Model\Values;

final class AssetClassAllocation extends Allocation
{
    public function __construct(AssetClass $tag, float $value)
    {
        parent::__construct($tag, $value);
    }

    public function getTag(): AssetClass
    {
        return parent::getTag();
    }
}
