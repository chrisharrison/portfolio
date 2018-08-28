<?php

declare(strict_types=1);

namespace ChrisHarrison\Portfolio\Model;

use ChrisHarrison\Portfolio\Model\Values\Allocations;

final class Fund
{
    private $id;
	private $name;
	private $ocf;
	private $allocations;

	public function __construct(string $id, string $name, float $ocf, Allocations $allocations)
	{
		$this->id = $id;
		$this->name = $name;
		$this->ocf = $ocf;
		$this->allocations = $allocations;
	}

    public function getId(): string
    {
        return $this->id;
    }

	public function getName(): string
	{
		return $this->name;
	}

	public function getOcf(): float
    {
        return $this->ocf;
    }

	public function getAllocations(): Allocations
	{
		return $this->allocations;
	}

	public function withAllocations(Allocations $allocations): self
    {
        return new self($this->id, $this->name, $this->ocf, $allocations);
    }
}
