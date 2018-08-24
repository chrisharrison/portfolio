<?php

declare(strict_types=1);

namespace ChrisHarrison\Portfolio\Application;

use ChrisHarrison\Portfolio\Application\Commands\Display;
use DI\ContainerBuilder;
use Psr\Container\ContainerInterface;
use Symfony\Component\Console\Application;

final class Container implements ContainerInterface
{
    private $container;

    public function __construct()
    {
        $builder = new ContainerBuilder;

        $builder->addDefinitions([
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
