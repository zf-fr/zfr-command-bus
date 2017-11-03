<?php

namespace ZfrCommandBusTest\Asset;

/**
 * @author Daniel Gimenes
 */
final class TestQueryHandler
{
    public function __invoke(TestQuery $query): array
    {
        return ['foo' => 'bar'];
    }
}
