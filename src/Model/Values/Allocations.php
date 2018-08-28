<?php

declare(strict_types=1);

namespace ChrisHarrison\Portfolio\Model\Values;

use ChrisHarrison\Portfolio\Model\Exceptions\InvalidAllocations;
use function is_a;
use function serialize;

final class Allocations
{
	private $allocations;

	public function __construct(array $allocations)
	{
		$this->allocations = $this->consolidate($allocations);
	}

	public function asArray(): array
	{
		return $this->allocations;
	}

	public function byAllocationType(string $type): Allocations
    {
        $out = [];
        foreach ($this->allocations as $allocation) {
            if (is_a($allocation, $type)) {
                $out[] = $allocation;
            }
        }
        return new Allocations($out);
    }

    public function funds(): Allocations
    {
        return $this->byAllocationType(FundAllocation::class);
    }

    public function countries(): Allocations
    {
        return $this->byAllocationType(CountryAllocation::class);
    }

    public function regions(): Allocations
    {
        return $this->byAllocationType(RegionAllocation::class);
    }

    public function assetClasses(): Allocations
    {
        return $this->byAllocationType(AssetClassAllocation::class);
    }

	private static function consolidate(array $allocations): array
	{
		$index = [];
		$out = [];

		foreach($allocations as $allocation) {

            if (!$allocation instanceof Allocation) {
                throw new InvalidAllocations('Allocations can only contain Allocations.');
            }

			$type = $allocation->getType();
			$tag = serialize($allocation->getTag());
			$value = $allocation->getValue();

			if (!isset($index[$type][$tag])) {
			    $index[$type][$tag] = count($out);
				$out[] = $allocation;
				continue;
			}

			$previous = $out[$index[$type][$tag]];
			$out[$index[$type][$tag]] = $previous->withValue($previous->getValue() + $value);

		}

		return $out;
	}

	public function expand(): Allocations
    {
        $out = [];

        foreach ($this->allocations as $allocation) {
            if ($allocation instanceof FundAllocation) {
                $out = $this->expandFundAllocation($allocation, $out);
                continue;
            }
            $out[] = $allocation;
        }

        return new Allocations($out);
    }

    private function expandFundAllocation(FundAllocation $fundAllocation, array $carry): array
    {
        $subAllocations = $fundAllocation->getTag()->getAllocations()->expand();
        foreach ($subAllocations->asArray() as $allocation) {
            /* @var Allocation $allocation */
            $carry[] = $allocation->withValue(($fundAllocation->getValue()/100)*($allocation->getValue()/100)*100);
        }

        return $carry;
    }
}
