<?php

declare(strict_types=1);

namespace ChrisHarrison\Portfolio\Model\Values;

final class Allocations
{
	private $allocations;

	public function __construct(array $allocations)
	{
		$this->allocations = $allocations;
	}

	public function asArray(): array
	{
		return $this->allocations;
	}

	public function resolve(): Allocations
	{
		$out = [];

		foreach ($this->allocations as $allocation) {
			if ($allocation instanceof FundAllocation) {
				$fundAllocations = $allocation->getTag()->getAllocations()->resolve()->asArray();
				foreach ($fundAllocations as $fundAllocation) {
					$calculatedValue = ($allocation->getValue()/100)*$fundAllocation->getValue();
					$out[] = $fundAllocation->withValue($calculatedValue);
				}
				continue;
			}
			$out[] = $allocation;
		}

		return (new Allocations($out))->consolidate();
	}

	private function consolidate(): Allocations
	{
		$index = [];
		$out = [];

		foreach($this->allocations as $allocation) {

			$type = get_class($allocation);
			$tag = $allocation->getTag();
			$value = $allocation->getValue();

			if (!isset($index[$type][$tag])) {
				$index[$type][$tag] = count($out);
				$out[] = $allocation;
				continue;
			}

			$previous = $out[$index[$type][$tag]];
			$out[$index[$type][$tag]] = $previous->withValue($previous->getValue() + $value);

		}

		return new Allocations($out);
	}
}
