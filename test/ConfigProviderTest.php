<?php

namespace ZfrCommandBusTest;

use ZfrCommandBus\ConfigProvider;

class ConfigProviderTest extends \PHPUnit_Framework_TestCase
{
    public function testProvidesContainerConfig()
    {
        $configProvider = new ConfigProvider();

        $this->assertArrayHasKey('dependencies', $configProvider());
    }
}
