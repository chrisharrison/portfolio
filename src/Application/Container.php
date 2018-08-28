<?php

declare(strict_types=1);

namespace ChrisHarrison\Portfolio\Application;

use ChrisHarrison\Portfolio\Application\Commands\Display;
use ChrisHarrison\Portfolio\Infrastructure\HardcodedFundCollection;
use ChrisHarrison\Portfolio\Infrastructure\HardcodedPortfolioCollection;
use ChrisHarrison\Portfolio\Model\FundCollection;
use ChrisHarrison\Portfolio\Model\PortfolioCollection;
use DI\ContainerBuilder;
use function DI\create;
use Psr\Container\ContainerInterface;
use Symfony\Component\Console\Application;

final class Container implements ContainerInterface
{
    private $container;

    public function __construct()
    {
        $builder = new ContainerBuilder;

        $builder->addDefinitions([
            FundCollection::class => create(HardcodedFundCollection::class),
            PortfolioCollection::class => function(\DI\Container $c) {
                return new HardcodedPortfolioCollection($c->get(FundCollection::class));
            },
            Application::class => function (\DI\Container $c) {
                $app = new Application('portfolio');
                $app->addCommands([
                    $c->get(Display::class),
                ]);
                return $app;
            },
        ]);

        $this->container = $builder->build();
    }

    public function get($id)
    {
        return $this->container->get($id);
    }

    public function has($id)
    {
        return $this->container->has($id);
    }

}
