<?php

namespace App\Strategy;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;

class FormatCompilerPass implements CompilerPassInterface
{
    public function process(ContainerBuilder $container)
    {
        $resolverService = $container->findDefinition(Format::class);

        $strategyServices = array_keys($container->findTaggedServiceIds(FormatInterface::SERVICE_TAG));

        foreach ($strategyServices as $strategyService) {
            $resolverService->addMethodCall('addStrategy', [new Reference($strategyService)]);
        }
    }
}
