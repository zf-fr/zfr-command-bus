<?php

namespace ZfrCommandBus;

use Interop\Container\ContainerInterface;
use ZfrCommandBus\Exception\InvalidArgumentException;
use ZfrCommandBus\Exception\RuntimeException;

class SimpleCommandBus implements CommandBusInterface
{
    /**
     * @var ContainerInterface
     */
    private $container;

    /**
     * @var array
     */
    private $commandMap;

    /**
     * @param ContainerInterface $container
     * @param array              $commandMap
     */
    public function __construct(ContainerInterface $container, array $commandMap = [])
    {
        $this->container  = $container;
        $this->commandMap = $commandMap;
    }

    /**
     * {@inheritDoc}
     *
     * @throws RuntimeException
     */
    public function dispatch($command)
    {
        if (!is_object($command)) {
            throw new InvalidArgumentException(sprintf(
                '$command must be an object, %s given',
                gettype($command)
            ));
        }

        $commandClass       = get_class($command);
        $commandHandlerName = $this->commandMap[$commandClass] ?? "{$commandClass}Handler";
        $commandHandler     = $this->container->get($commandHandlerName);

        assert(is_callable($commandHandler), 'Make sure your command handler is callable');

        $commandHandler($command);
    }
}
