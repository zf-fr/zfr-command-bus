<?php

namespace ZfrCommandBus;

use Psr\Container\ContainerInterface;
use ZfrCommandBus\Exception\InvalidArgumentException;
use ZfrCommandBus\Exception\RuntimeException;

/**
 * @author Daniel Gimenes
 */
final class SimpleQueryBus implements QueryBusInterface
{
    /**
     * @var ContainerInterface
     */
    private $container;

    /**
     * @var array
     */
    private $queryMap;

    /**
     * @param ContainerInterface $container
     * @param array              $queryMap
     */
    public function __construct(ContainerInterface $container, array $queryMap = [])
    {
        $this->container = $container;
        $this->queryMap  = $queryMap;
    }

    /**
     * {@inheritDoc}
     *
     * @throws RuntimeException
     */
    public function dispatch($query): array
    {
        if (!is_object($query)) {
            throw new InvalidArgumentException(sprintf(
                '$query must be an object, %s given',
                gettype($query)
            ));
        }

        $queryClass       = get_class($query);
        $queryHandlerName = $this->queryMap[$queryClass] ?? "{$queryClass}Handler";
        $queryHandler     = $this->container->get($queryHandlerName);

        assert(is_callable($queryHandler), 'Make sure your query handler is callable');

        return $queryHandler($query);
    }
}
