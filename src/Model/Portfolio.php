<?php

declare(strict_types=1);

namespace ChrisHarrison\Portfolio\Model;

use ChrisHarrison\Portfolio\Model\Exceptions\InvalidPortfolio;
use ChrisHarrison\Portfolio\Model\Values\Allocations;
use ChrisHarrison\Portfolio\Model\Values\FundAllocation;

final class Portfolio
{
	private $id;
	private $name;
	private $value;
	private $allocations;

	public function __construct(
	    string $id,
        string $name,
        float $value,
        Allocations $allocations
    ) {
		$this->id = $id;
		$this->name = $name;
		$this->value = $value;
		$this->allocations = $allocations;
		$this->validate();
	}

    public function getId(): string
    {
        return $this->id;
    }

	public function getName(): string
	{
		return $this->name;
	}

    public function getValue(): float
    {
        return $this->value;
    }

	public function getAllocations(): Allocations
	{
		return $this->allocations;
	}

	public function ocfPercentage(): float
    {
        $out = 0;
        $fundAllocations = $this->getAllocations()->funds()->asArray();
        foreach ($fundAllocations as $allocation) {
            /* @var FundAllocation $allocation */
            $out += ($allocation->getValue()/100)*($allocation->getTag()->getOcf()/100);
        }
        return $out*100;
    }

    public function ocfAmount(): float
    {
        return ($this->value/100)*$this->ocfPercentage();
    }

    private function validate(): void
    {
        $total = 0;
        foreach ($this->allocations->asArray() as $allocation) {
            if (!$allocation instanceof FundAllocation) {
                throw new InvalidPortfolio('Only fund allocations can be added to a portfolio.');
            }
            $total += $allocation->getValue();
        }
    }
}
