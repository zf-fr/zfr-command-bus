<?php

namespace ZfrCommandBus;

interface CommandBusInterface
{
    /**
     * @param object $command
     *
     * @return void
     */
    public function dispatch($command);
}
