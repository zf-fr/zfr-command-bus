<?php

namespace ZfrCommandBusTest;

use Interop\Container\ContainerInterface;
use ZfrCommandBus\Exception\InvalidArgumentException;
use ZfrCommandBus\Exception\RuntimeException;
use ZfrCommandBus\SimpleCommandBus;

class SimpleCommandBusTest extends \PHPUnit_Framework_TestCase
{
    public function testThrowsExceptionIfInvalidCommandType()
    {
        $container  = $this->prophesize(ContainerInterface::class);
        $commandMap = [];
        $commandBus = new SimpleCommandBus($container->reveal(), $commandMap);

        $this->setExpectedException(InvalidArgumentException::class);

        $commandBus->dispatch('string');
    }

    public function testThrowsExceptionIfCommandHandlerIsNotRegistered()
    {
        $container  = $this->prophesize(ContainerInterface::class);
        $commandMap = [];
        $commandBus = new SimpleCommandBus($container->reveal(), $commandMap);

        $this->setExpectedException(RuntimeException::class);

        $commandBus->dispatch(new \stdClass());
    }

    public function testDispatchesCommandToMappedCommandHandler()
    {
        $container      = $this->prophesize(ContainerInterface::class);
        $commandMap     = [\stdClass::class => 'My\TestCommandHandler'];
        $commandBus     = new SimpleCommandBus($container->reveal(), $commandMap);
        $command        = new \stdClass();
        $commandHandler = $this->createTraceableCommandHandler();

        $container->get('My\TestCommandHandler')->shouldBeCalled()->willReturn($commandHandler);

        $commandBus->dispatch($command);

        $this->assertTrue($commandHandler->isCalled);
        $this->assertSame($command, $commandHandler->command);
    }

    private function createTraceableCommandHandler()
    {
        // @codingStandardsIgnoreStart
        return new class {
            public $isCalled = false;

            public $command;

            public function __invoke(\stdClass $command)
            {
                $this->isCalled = true;
                $this->command  = $command;
            }
        };
        // @codingStandardsIgnoreEnd
    }
}
