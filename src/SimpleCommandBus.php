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
    public function __construct(ContainerInterface $container, array $commandMap)
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

        $commandClass = get_class($command);

        if (!isset($this->commandMap[$commandClass])) {
            throw new RuntimeException(sprintf(
                'No command handler was registered for "%s"',
                $commandClass
            ));
        }

        /** @var callable $commandHandler */
        $commandHandler = $this->container->get($this->commandMap[$commandClass]);

        assert(is_callable($commandHandler), 'Make sure your command handler is callable');

        $commandHandler($command);
    }
}
