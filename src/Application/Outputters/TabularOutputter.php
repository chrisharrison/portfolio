<?php

declare(strict_types=1);

namespace ChrisHarrison\Portfolio\Application\Outputters;

use ChrisHarrison\Portfolio\Model\Portfolio;
use ChrisHarrison\Portfolio\Model\Values\Allocation;
use ChrisHarrison\Portfolio\Model\Values\AssetClassAllocation;
use ChrisHarrison\Portfolio\Model\Values\CountryAllocation;
use ChrisHarrison\Portfolio\Model\Values\RegionAllocation;
use Symfony\Component\Console\Helper\Table;
use Symfony\Component\Console\Output\OutputInterface;

final class TabularOutputter
{
    public function output(OutputInterface $output, Portfolio $portfolio): void
    {
        $regionAllocations = [];
        $countryAllocations = [];
        $assetClassAllocations = [];

        foreach ($portfolio->getAllocations()->expand()->asArray() as $allocation) {
            /* @var Allocation $allocation */
            if ($allocation instanceof RegionAllocation) {
                $regionAllocations[] = [
                    $allocation->getTag()->getName(),
                    $allocation->getValue()
                ];
            }
            if ($allocation instanceof CountryAllocation) {
                $countryAllocations[] = [
                    $allocation->getTag()->getName(),
                    $allocation->getValue()
                ];
            }
            if ($allocation instanceof AssetClassAllocation) {
                $assetClassAllocations[] = [
                    $allocation->getTag()->getName(),
                    $allocation->getValue()
                ];
            }
        }

        if (count($regionAllocations) > 0) {
            $table = new Table($output);
            $table
                ->setHeaders(['Region', 'Allocation'])
                ->setRows($regionAllocations);
            $table->render();
        }

        if (count($countryAllocations) > 0) {
            $table = new Table($output);
            $table
                ->setHeaders(['Country', 'Allocation'])
                ->setRows($countryAllocations);
            $table->render();
        }

        if (count($assetClassAllocations) > 0) {
            $table = new Table($output);
            $table
                ->setHeaders(['Asset class', 'Allocation'])
                ->setRows($assetClassAllocations);
            $table->render();
        }
    }
}
