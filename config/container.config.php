<?php

use ZfrCommandBus\CommandBusInterface;
use ZfrCommandBus\Container\SimpleCommandBusFactory;
use ZfrCommandBus\SimpleCommandBus;

return [
    'container' => [
        'aliases' => [
            CommandBusInterface::class => SimpleCommandBus::class,
        ],
        'factories' => [
            SimpleCommandBus::class => SimpleCommandBusFactory::class,
        ],
    ]
];
