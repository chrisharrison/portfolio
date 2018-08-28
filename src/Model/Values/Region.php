<?php

declare(strict_types=1);

namespace ChrisHarrison\Portfolio\Model\Values;

final class Region
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

    public static function EUROPE(): self
    {
        return new Region('Europe');
    }

    public static function EUROPE_X_UK(): self
    {
        return new Region('Europe (ex. UK)');
    }

    public static function EUROPE_ONLY_UK(): self
    {
        return new Region('Europe (only UK)');
    }

    public static function NORTH_AMERICA(): self
    {
        return new Region('North America');
    }
}
