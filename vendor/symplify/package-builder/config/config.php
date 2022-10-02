<?php

declare (strict_types=1);
namespace EasyCI202210;

use EasyCI202210\SebastianBergmann\Diff\Differ;
use EasyCI202210\Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;
use EasyCI202210\Symplify\PackageBuilder\Console\Formatter\ColorConsoleDiffFormatter;
use EasyCI202210\Symplify\PackageBuilder\Console\Output\ConsoleDiffer;
use EasyCI202210\Symplify\PackageBuilder\Diff\Output\CompleteUnifiedDiffOutputBuilderFactory;
use EasyCI202210\Symplify\PackageBuilder\Reflection\PrivatesAccessor;
return static function (ContainerConfigurator $containerConfigurator) : void {
    $services = $containerConfigurator->services();
    $services->defaults()->public()->autowire();
    $services->set(ColorConsoleDiffFormatter::class);
    $services->set(ConsoleDiffer::class);
    $services->set(CompleteUnifiedDiffOutputBuilderFactory::class);
    $services->set(Differ::class);
    $services->set(PrivatesAccessor::class);
};
