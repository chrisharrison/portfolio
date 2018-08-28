<?php

declare(strict_types=1);

namespace ChrisHarrison\Portfolio\Model;

interface FundCollection
{
    public function getById(string $id): Fund;
}
