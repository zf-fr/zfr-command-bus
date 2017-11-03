<?php

namespace ZfrCommandBusTest\Asset;

/**
 * @author Daniel Gimenes
 */
final class TestCommandHandler
{
    public function __invoke(TestCommand $command): void
    {
    }
}
