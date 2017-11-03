<?php

namespace ZfrCommandBus\Container;

use Interop\Container\ContainerInterface;
use ZfrCommandBus\SimpleCommandBus;

class SimpleCommandBusFactory
{
    /**
     * @param ContainerInterface $container
     *
     * @return SimpleCommandBus
     */
    public function __invoke(ContainerInterface $container): SimpleCommandBus
    {
        /** @var array $config */
        $config = $container->get('config');

        return new SimpleCommandBus($container, $config['zfr_command_bus']['command_handlers'] ?? []);
    }
}
