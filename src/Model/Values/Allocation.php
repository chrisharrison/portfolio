<?php

declare(strict_types=1);

namespace ChrisHarrison\Portfolio\Model\Values;

abstract class Allocation
{
	private $tag;
	private $value;

	public function __construct($tag, float $value)
	{
		$this->tag = $tag;
		$this->value = $value;
	}

	public function getTag()
	{
		return $this->tag;
	}

	public function getValue(): float
	{
		return $this->value;
	}

	public function withValue(float $value)
	{
		return new static($this->tag, $value);
	}
}
