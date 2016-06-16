<?php

namespace ZfrCommandBus;

class ConfigProvider
{
    /**
     * @return array
     */
    public function __invoke(): array
    {
        return require __DIR__ . '/../config/container.config.php';
    }
}
