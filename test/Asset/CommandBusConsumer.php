<?php

namespace ZfrCommandBusTest\Asset;

use ZfrCommandBus\CommandBusInterface;

class CommandBusConsumer
{
    /**
     * @var CommandBusInterface
     */
    private $commandBus;

    /**
     * @param CommandBusInterface $commandBus
     */
    public function __construct(CommandBusInterface $commandBus)
    {
        $this->commandBus = $commandBus;
    }

    /**
     * @return CommandBusInterface
     */
    public function getCommandBus(): CommandBusInterface
    {
        return $this->commandBus;
    }
}
