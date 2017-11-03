<?php

use ZfrCommandBus\CommandBusInterface;
use ZfrCommandBus\Container\SimpleCommandBusFactory;
use ZfrCommandBus\Container\SimpleQueryBusFactory;
use ZfrCommandBus\QueryBusInterface;
use ZfrCommandBus\SimpleCommandBus;
use ZfrCommandBus\SimpleQueryBus;

return [
    'dependencies' => [
        'aliases' => [
            CommandBusInterface::class => SimpleCommandBus::class,
            QueryBusInterface::class   => SimpleQueryBus::class,
        ],
        
        'factories' => [
            SimpleCommandBus::class => SimpleCommandBusFactory::class,
            SimpleQueryBus::class   => SimpleQueryBusFactory::class,
        ],
    ]
];
