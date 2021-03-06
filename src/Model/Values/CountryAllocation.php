<?php

declare(strict_types=1);

namespace ChrisHarrison\Portfolio\Model\Values;

final class CountryAllocation extends Allocation
{
    public function __construct(Country $tag, float $value)
    {
        parent::__construct($tag, $value);
    }

    public function getTag(): Country
    {
        return parent::getTag();
    }
}
