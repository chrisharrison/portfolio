<?php

declare(strict_types=1);

namespace ChrisHarrison\Portfolio\Model\Values;

final class Country
{
    private $code;
    private $name;

    public function __construct(string $code, string $name)
    {
        $this->code = $code;
        $this->name = $name;
    }

    public function getCode(): string
    {
        return $this->code;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public static function UK(): self
    {
        return new self('UK', 'United Kingdom');
    }

    public static function US(): self
    {
        return new self('US', 'United States');
    }

    public static function FR(): self
    {
        return new self('FR', 'France');
    }
}
