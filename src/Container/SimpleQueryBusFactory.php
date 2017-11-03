<?php

namespace ZfrCommandBus\Container;

use Psr\Container\ContainerInterface;
use ZfrCommandBus\QueryBusInterface;
use ZfrCommandBus\SimpleQueryBus;

/**
 * @author Daniel Gimenes
 */
final class SimpleQueryBusFactory
{
    /**
     * @param ContainerInterface $container
     *
     * @return QueryBusInterface
     */
    public function __invoke(ContainerInterface $container): QueryBusInterface
    {
        /** @var array $config */
        $config = $container->get('config');

        return new SimpleQueryBus($container, $config['zfr_command_bus']['query_handlers'] ?? []);
    }
}
