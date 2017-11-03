<?php

namespace ZfrCommandBusTest\Container;

use Psr\Container\ContainerInterface;
use ZfrCommandBus\Container\SimpleQueryBusFactory;

/**
 * @author Daniel Gimenes
 */
final class SimpleQueryBusFactoryTest extends \PHPUnit_Framework_TestCase
{
    public function testUsesEmptyHandlerMapByDefault()
    {
        $container = $this->prophesize(ContainerInterface::class);
        $factory   = new SimpleQueryBusFactory();

        $container->get('config')->shouldBeCalled()->willReturn([]);

        $factory($container->reveal());
    }

    public function testCreatesInstanceOfSimpleQueryBus()
    {
        $container = $this->prophesize(ContainerInterface::class);
        $factory   = new SimpleQueryBusFactory();

        $container->get('config')->shouldBeCalled()->willReturn([
            'zfr_command_bus' => [
                'query_handlers' => [],
            ],
        ]);

        $factory($container->reveal());
    }
}
