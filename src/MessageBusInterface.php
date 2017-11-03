<?php

namespace ZfrCommandBus;

/**
 * @author Daniel Gimenes
 */
interface MessageBusInterface
{
    /**
     * @param object $message
     *
     * @return array|void
     */
    public function dispatch($message);
}
