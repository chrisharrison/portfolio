<?php

declare(strict_types=1);

namespace ChrisHarrison\Portfolio\Model\Values;

final class AssetClass
{
    private $name;

    public function __construct(string $name)
    {
        $this->name = $name;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public static function EQUITY(): self
    {
        return new self('Equity');
    }

    public static function FIXED_INCOME(): self
    {
        return new self('Fixed income');
    }
}
