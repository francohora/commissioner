<?php
declare(strict_types=1);

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;

require_once __DIR__ . '/vendor/autoload.php';

$containerBuilder = new ContainerBuilder();
$loader = new YamlFileLoader($containerBuilder, new FileLocator(__DIR__));

try {
    $loader->load(__DIR__ . '/config/services.yaml');

    $calculator = $containerBuilder->get('app.calculator');

    echo $calculator->calculate($argv[1]);
} catch (Throwable $exception) {
    printf($exception->getMessage());
}
