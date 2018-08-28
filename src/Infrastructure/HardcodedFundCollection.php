<?php

declare(strict_types=1);

namespace ChrisHarrison\Portfolio\Infrastructure;

use ChrisHarrison\Portfolio\Model\Fund;
use ChrisHarrison\Portfolio\Model\FundCollection;
use ChrisHarrison\Portfolio\Model\Values\Allocations;
use ChrisHarrison\Portfolio\Model\Values\AssetClass;
use ChrisHarrison\Portfolio\Model\Values\AssetClassAllocation;
use ChrisHarrison\Portfolio\Model\Values\Country;
use ChrisHarrison\Portfolio\Model\Values\CountryAllocation;
use ChrisHarrison\Portfolio\Model\Values\FundAllocation;
use ChrisHarrison\Portfolio\Model\Values\Region;
use ChrisHarrison\Portfolio\Model\Values\RegionAllocation;

final class HardcodedFundCollection implements FundCollection
{
    public function getById(string $id): Fund
    {
        return $this->$id();
    }

    private function lifeStrategy100(): Fund
    {
        return new Fund(
            'lifeStrategy100',
            'LifeStrategy 100% Equity Fund',
            0.22,
            new Allocations([
                new FundAllocation($this->usEquity(), 19.2),
                new FundAllocation($this->ftseDevelopedWorldExUKEquity(), 19.2),
                new FundAllocation($this->ftseUKAllShare(), 18.2),
                new FundAllocation($this->sp500(), 12.6),
                new FundAllocation($this->ftseDevelopedEuropeExUKEquity(), 8.7),
//                new FundAllocation($this->emergingMarketsStock(), 7.9),
//                new FundAllocation($this->ftse100(), 5.8),
//                new FundAllocation($this->japanStock(), 4.9),
//                new FundAllocation($this->pacificExJapanStock(), 2.4),
//                new FundAllocation($this->ftse250(), 1.1),
            ])
        );
    }

    private function usEquity(): Fund
    {
        return new Fund(
            'usEquity',
            'U.S. Equity Index Fund',
            0.10,
            new Allocations([
                new AssetClassAllocation(AssetClass::EQUITY(), 100),
                new CountryAllocation(Country::US(), 100),
                new RegionAllocation(Region::NORTH_AMERICA(), 100),
            ])
        );
    }

    private function ftseDevelopedWorldExUKEquity(): Fund
    {
        return new Fund(
            'ftseDevelopedWorldExUKEquity',
            'FTSE Developed World ex-U.K. Equity Index Fund',
            0.15,
            new Allocations([
                new AssetClassAllocation(AssetClass::EQUITY(), 100),
//                new CountryAllocation('US', 62.8),
//                new CountryAllocation('Japan', 9.8),
//                new CountryAllocation('France', 4),
//                new CountryAllocation('Germany', 3.7),
//                new CountryAllocation('Canada', 3.3),
//                new CountryAllocation('Switzerland', 3),
//                new CountryAllocation('Australia', 2.7),
//                new CountryAllocation('Korea', 1.8),
//                new CountryAllocation('Hong Kong', 1.5),
//                new CountryAllocation('Netherlands', 1.4),
//                new CountryAllocation('Spain', 1.2),
//                new CountryAllocation('Italy', 1),
//                new CountryAllocation('Sweden', 1),
//                new CountryAllocation('Denmark', 0.6),
//                new CountryAllocation('Singapore', 0.5),
//                new CountryAllocation('Belgium', 0.4),
//                new CountryAllocation('Finland', 0.4),
//                new CountryAllocation('Norway', 0.3),
//                new CountryAllocation('Israel', 0.2),
//                new CountryAllocation('Austria', 0.1),
//                new CountryAllocation('Ireland', 0.1),
//                new CountryAllocation('New Zealand', 0.1),
//                new CountryAllocation('Portugal', 0.1),
            ])
        );
    }

    private function ftseUKAllShare(): Fund
    {
        return new Fund(
            'ftseUKAllShare',
            'FTSE U.K. All Share Index Unit Trust',
            0.08,
            new Allocations([
                new AssetClassAllocation(AssetClass::EQUITY(), 100),
                new CountryAllocation(Country::UK(), 100),
                new RegionAllocation(Region::EUROPE(), 100),
                new RegionAllocation(Region::EUROPE_ONLY_UK(), 100),
            ])
        );
    }

    private function sp500(): Fund
    {
        return new Fund(
            'sp500',
            'S&P 500 UCITS ETF',
            0.07,
            new Allocations([
                new AssetClassAllocation(AssetClass::EQUITY(), 100),
                new CountryAllocation(Country::US(), 100),
                new RegionAllocation(Region::NORTH_AMERICA(), 100),
            ])
        );
    }

    private function ftseDevelopedEuropeExUKEquity(): Fund
    {
        return new Fund(
            'ftseDevelopedEuropeExUKEquity',
            'FTSE Developed Europe ex-U.K. Equity Index Fund',
            0.12,
            new Allocations([
                new AssetClassAllocation(AssetClass::EQUITY(), 100),
                new CountryAllocation(Country::FR(), 100),
                new RegionAllocation(Region::EUROPE(), 100),
                new RegionAllocation(Region::EUROPE_X_UK(), 100),
            ])
        );
    }
}
