<?php

namespace ZfrCommandBusTest\Container;

use Interop\Container\ContainerInterface;
use ZfrCommandBus\CommandBusInterface;
use ZfrCommandBus\Container\CommandBusConsumerFactory;
use ZfrCommandBusTest\Asset\CommandBusConsumer;

class CommandBusConsumerFactoryTest extends \PHPUnit_Framework_TestCase
{
    public function testCreatesInstanceOfSimpleCommandBus()
    {
        $container  = $this->prophesize(ContainerInterface::class);
        $commandBus = $this->prophesize(CommandBusInterface::class);

        $container->get(CommandBusInterface::class)->shouldBeCalled()->willReturn($commandBus);

        $instance = (new CommandBusConsumerFactory())->__invoke($container->reveal(), CommandBusConsumer::class);

        $this->assertSame($commandBus->reveal(), $instance->getCommandBus());
    }
}
