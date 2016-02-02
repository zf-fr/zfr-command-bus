<?php

use ZfrCommandBus\CommandBusInterface;
use ZfrCommandBus\Container\SimpleCommandBusFactory;
use ZfrCommandBus\SimpleCommandBus;

return [
    'dependencies' => [
        'aliases' => [
            CommandBusInterface::class => SimpleCommandBus::class,
        ],
        
        'factories' => [
            SimpleCommandBus::class => SimpleCommandBusFactory::class,
        ],
    ]
];
