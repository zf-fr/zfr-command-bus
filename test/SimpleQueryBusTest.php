<?php

namespace ZfrCommandBusTest;

use Prophecy\Prophecy\ObjectProphecy;
use Psr\Container\ContainerInterface;
use stdClass;
use ZfrCommandBus\Exception\InvalidArgumentException;
use ZfrCommandBus\SimpleQueryBus;
use ZfrCommandBusTest\Asset\TestQuery;
use ZfrCommandBusTest\Asset\TestQueryHandler;

/**
 * @author Daniel Gimenes
 */
final class SimpleQueryBusTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var ObjectProphecy|ContainerInterface
     */
    private $container;

    /**
     * @var callable
     */
    private $queryHandler;

    protected function setUp()
    {
        $this->container    = $this->prophesize(ContainerInterface::class);
        $this->queryHandler = function (stdClass $query) {
            return ['foo' => 'bar'];
        };
    }

    public function testThrowsExceptionIfInvalidQueryType()
    {
        $queryBus = new SimpleQueryBus($this->container->reveal());

        $this->setExpectedException(InvalidArgumentException::class);

        $queryBus->dispatch('string');
    }

    public function testDispatchesQueryToMappedQueryHandler()
    {
        $queryBus = new SimpleQueryBus($this->container->reveal(), [stdClass::class => 'My\TestQueryHandler']);

        $this->container->get('My\TestQueryHandler')->shouldBeCalled()->willReturn($this->queryHandler);

        $result = $queryBus->dispatch(new stdClass());

        $this->assertSame(['foo' => 'bar'], $result);
    }

    public function testTriesToGuessQueryHandlerNameWithSuffix()
    {
        $queryBus = new SimpleQueryBus($this->container->reveal());

        $this->container->get(TestQueryHandler::class)->shouldBeCalled()->willReturn(new TestQueryHandler());

        $result = $queryBus->dispatch(new TestQuery());

        $this->assertSame(['foo' => 'bar'], $result);
    }
}
