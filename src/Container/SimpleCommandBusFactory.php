<?php

namespace ZfrCommandBus\Container;

use Interop\Container\ContainerInterface;
use ZfrCommandBus\Exception\OutOfBoundsException;
use ZfrCommandBus\SimpleCommandBus;

class SimpleCommandBusFactory
{
    /**
     * @param ContainerInterface $container
     *
     * @throws OutOfBoundsException
     *
     * @return SimpleCommandBus
     */
    public function __invoke(ContainerInterface $container): SimpleCommandBus
    {
        /** @var array $config */
        $config = $container->get('config');

        if (!isset($config['zfr_command_bus']['command_handlers'])) {
           throw new OutOfBoundsException('Missing config key [\'zfr_command_bus\'][\'command_handlers\']');
        }

        return new SimpleCommandBus($container, $config['zfr_command_bus']['command_handlers']);
    }
}
