<?php

declare(strict_types=1);

namespace ChrisHarrison\Portfolio\Infrastructure;

use ChrisHarrison\Portfolio\Model\FundCollection;
use ChrisHarrison\Portfolio\Model\Portfolio;
use ChrisHarrison\Portfolio\Model\PortfolioCollection;
use ChrisHarrison\Portfolio\Model\Values\Allocations;
use ChrisHarrison\Portfolio\Model\Values\FundAllocation;

final class HardcodedPortfolioCollection implements PortfolioCollection
{
    private $fundCollection;

    public function __construct(FundCollection $fundCollection)
    {
        $this->fundCollection = $fundCollection;
    }

    public function getById(string $id): Portfolio
    {
        return $this->$id();
    }

    private function longTerm(): Portfolio
    {
        return new Portfolio(
            'longTerm',
            'Long term',
            60,
            new Allocations([
                new FundAllocation($this->fundCollection->getById('lifeStrategy100'), 100),
            ])
        );
    }
}
