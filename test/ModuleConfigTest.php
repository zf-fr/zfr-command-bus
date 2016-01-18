<?php

namespace ZfrCommandBusTest;

use ZfrCommandBus\ModuleConfig;

class ModuleConfigTest extends \PHPUnit_Framework_TestCase
{
    public function testProvidesContainerConfig()
    {
        $moduleConfig = new ModuleConfig();

        $this->assertArrayHasKey('container', $moduleConfig());
    }
}
