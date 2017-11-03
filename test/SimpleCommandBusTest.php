<?php

namespace ZfrCommandBusTest;

use Interop\Container\ContainerInterface;
use ZfrCommandBus\Exception\InvalidArgumentException;
use ZfrCommandBus\SimpleCommandBus;
use ZfrCommandBusTest\Asset\TestCommand;
use ZfrCommandBusTest\Asset\TestCommandHandler;

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

    public function testTriesToGuessCommandHandlerNameWithSuffix()
    {
        $container      = $this->prophesize(ContainerInterface::class);
        $commandBus     = new SimpleCommandBus($container->reveal());
        $command        = new TestCommand();
        $commandHandler = $this->createTraceableCommandHandler();

        $container->get(TestCommandHandler::class)->shouldBeCalled()->willReturn($commandHandler);

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

            public function __invoke($command)
            {
                $this->isCalled = true;
                $this->command  = $command;
            }
        };
        // @codingStandardsIgnoreEnd
    }
}
