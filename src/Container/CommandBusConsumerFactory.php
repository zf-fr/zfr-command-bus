<?php

namespace ZfrCommandBus\Container;

use Interop\Container\ContainerInterface;
use ZfrCommandBus\CommandBusInterface;

/**
 * @author Michaël Gallego
 */
class CommandBusConsumerFactory
{
    /**
     * @param ContainerInterface $container
     * @param string             $requestedName
     */
    public function __invoke(ContainerInterface $container, string $requestedName)
    {
        /** @var CommandBusInterface $commandBus */
        $commandBus = $container->get(CommandBusInterface::class);

        return new $requestedName($commandBus);
    }
}
