<?php

declare(strict_types=1);

namespace ChrisHarrison\Portfolio\Model;

use ChrisHarrison\Portfolio\Model\Values\Allocations;

final class Fund
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
