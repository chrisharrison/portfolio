<?php

use ChrisHarrison\Portfolio\Application\Container;
use Symfony\Component\Console\Application;

require 'vendor/autoload.php';

$container = new Container;
$app = $container->get(Application::class);
$app->run();