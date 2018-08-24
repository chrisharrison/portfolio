<?php

declare(strict_types=1);

namespace ChrisHarrison\Portfolio\Application\Commands;

use ChrisHarrison\Portfolio\Application\Factories\FundFactory;
use ChrisHarrison\Portfolio\Application\Factories\PortfolioFactory;
use ChrisHarrison\Portfolio\Application\Outputters\TabularOutputter;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

final class Display extends Command
{
    private $portfolioFactory;
    private $fundFactory;
    private $tabularOutputter;

    protected static $defaultName = 'display';

    public function __construct(
        PortfolioFactory $portfolioFactory,
        FundFactory $fundFactory,
        TabularOutputter $tabularOutputter
    ) {
        $this->portfolioFactory = $portfolioFactory;
        $this->fundFactory = $fundFactory;
        $this->tabularOutputter = $tabularOutputter;
        parent::__construct();
    }

    protected function configure(): void
    {
        $this->setName(static::getDefaultName());
        $this->setDescription('Display a portfolio.');
        $this->addArgument('portfolio',InputArgument::OPTIONAL, 'Portfolio to load', 'default');
    }

    public function execute(InputInterface $input, OutputInterface $output): void
    {
        $portfolio = $this->portfolioFactory->get($input->getArgument('portfolio'));
        $this->tabularOutputter->output($output, $portfolio);
    }
}
