<?php

declare(strict_types=1);

namespace ChrisHarrison\Portfolio\Application\Factories;

use ChrisHarrison\Portfolio\Model\Portfolio;
use ChrisHarrison\Portfolio\Model\Values\Allocations;
use ChrisHarrison\Portfolio\Model\Values\AssetClassAllocation;
use function method_exists;

final class PortfolioFactory
{
    public function get(string $name): ?Portfolio
    {
        if ($name == 'default') {
            return $this->_default();
        }

        if (method_exists($this, $name)) {
            return $this->$name();
        }

        return null;
    }
    
    public function _default(): Portfolio
    {
        return $this->mediumRisk();
    }

    public function mediumRisk(): Portfolio
    {
        return new Portfolio('Medium risk', new Allocations([
            new AssetClassAllocation('Equities', 60),
            new AssetClassAllocation('Fixed income', 40),
        ]));
    }
}
