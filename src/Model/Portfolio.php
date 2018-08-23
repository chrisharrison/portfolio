<?php

namespace ChrisHarrison\Portfolio\Model;

use ChrisHarrison\Portfolio\Model\Values\Allocations;

final class Portfolio
{
	private $name;
	private $allocations;

	public function __construct(string $name, Allocations $allocations)
	{
		$this->name = $name;
		$this->allocations = $allocations;
	}

	public function getName(): string
	{
		return $this->name;
	}

	public function getAllocations(): Allocations
	{
		return $this->allocations;
	}
}
