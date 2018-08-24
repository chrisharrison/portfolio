<?php

declare(strict_types=1);

namespace ChrisHarrison\Portfolio\Application;

use ChrisHarrison\Portfolio\Model\Fund;
use ChrisHarrison\Portfolio\Model\Portfolio;
use ChrisHarrison\Portfolio\Model\Values\Allocation;
use ChrisHarrison\Portfolio\Model\Values\Allocations;
use ChrisHarrison\Portfolio\Model\Values\FundAllocation;
use ChrisHarrison\Portfolio\Model\Values\CountryAllocation;

final class Monolith
{
	private $portfolio;

	public function __construct()
	{
		$fund1 = new Fund('Europe', new Allocations([
			new CountryAllocation('Germany', 80),
			new CountryAllocation('Italy', 5),
			new CountryAllocation('France', 15),
		]));

		$fund2 = new Fund('US', new Allocations([
			new CountryAllocation('US', 100),
		]));

		$fund3 = new Fund('Blended', new Allocations([
			new FundAllocation($fund1, 50),
			new FundAllocation($fund2, 50),
		]));

		$this->portfolio = new Portfolio('Test', new Allocations([
			new FundAllocation($fund1, 30),
			new FundAllocation($fund2, 30),
			new FundAllocation($fund3, 40),
		]));
	}

	public function output()
	{
		foreach ($this->portfolio->getAllocations()->resolve()->asArray() as $allocation) {
		    /* @var Allocation $allocation */
			echo $allocation->getTag() . ' : ' . $allocation->getValue() . '%' . PHP_EOL;
		}
	}
}
