<?php

namespace ZfrCommandBusTest\Container;

use Interop\Container\ContainerInterface;
use ZfrCommandBus\Container\SimpleCommandBusFactory;
use ZfrCommandBus\Exception\OutOfBoundsException;

class SimpleCommandBusFactoryTest extends \PHPUnit_Framework_TestCase
{
    public function testThrowsExceptionIfMissingConfigKey()
    {
        $container = $this->prophesize(ContainerInterface::class);
        $factory   = new SimpleCommandBusFactory();

        $container->get('config')->shouldBeCalled()->willReturn([]);

        $this->setExpectedException(OutOfBoundsException::class);

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
