<?php

declare(strict_types=1);

namespace ChrisHarrison\Portfolio\Application\Commands;

use ChrisHarrison\Portfolio\Application\Outputters\TabularOutputter;
use ChrisHarrison\Portfolio\Model\FundCollection;
use ChrisHarrison\Portfolio\Model\PortfolioCollection;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

final class Display extends Command
{
    private $portfolioCollection;
    private $fundCollection;
    private $tabularOutputter;

    protected static $defaultName = 'display';

    public function __construct(
        PortfolioCollection $portfolioCollection,
        FundCollection $fundCollection,
        TabularOutputter $tabularOutputter
    ) {
        $this->portfolioCollection = $portfolioCollection;
        $this->fundCollection = $fundCollection;
        $this->tabularOutputter = $tabularOutputter;
        parent::__construct();
    }

    protected function configure(): void
    {
        $this->setName(static::getDefaultName());
        $this->setDescription('Display a portfolio.');
        $this->addArgument('portfolio',InputArgument::REQUIRED, 'Portfolio to load');
    }

    public function execute(InputInterface $input, OutputInterface $output): void
    {
        $portfolio = $this->portfolioCollection->getById($input->getArgument('portfolio'));
        $this->tabularOutputter->output($output, $portfolio);
    }
}
