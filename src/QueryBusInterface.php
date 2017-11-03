<?php

namespace ZfrCommandBus;

/**
 * @author Daniel Gimenes
 */
interface QueryBusInterface extends MessageBusInterface
{
    /**
     * @param object $query
     *
     * @return array
     */
    public function dispatch($query): array;
}
