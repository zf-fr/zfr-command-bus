<?php

namespace ZfrCommandBus;

interface CommandBusInterface extends MessageBusInterface
{
    /**
     * @param object $command
     *
     * @return void
     */
    public function dispatch($command);
}
