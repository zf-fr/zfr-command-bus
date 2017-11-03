<?php

namespace ZfrCommandBusTest\Container;

use Interop\Container\ContainerInterface;
use ZfrCommandBus\Container\SimpleCommandBusFactory;

class SimpleCommandBusFactoryTest extends \PHPUnit_Framework_TestCase
{
    public function testUsesEmptyHandlerMapByDefault()
    {
        $container = $this->prophesize(ContainerInterface::class);
        $factory   = new SimpleCommandBusFactory();

        $container->get('config')->shouldBeCalled()->willReturn([]);

        $factory($container->reveal());
    }

    public function testCreatesInstanceOfSimpleCommandBus()
    {
        $container = $this->prophesize(ContainerInterface::class);
        $factory   = new SimpleCommandBusFactory();

        $container->get('config')->shouldBeCalled()->willReturn([
            'zfr_command_bus' => [
                'command_handlers' => [],
            ],
        ]);

        $factory($container->reveal());
    }
}
