<?php

declare(strict_types=1);

namespace ChrisHarrison\Portfolio\Model;

interface PortfolioCollection
{
    public function getById(string $id): Portfolio;
}
