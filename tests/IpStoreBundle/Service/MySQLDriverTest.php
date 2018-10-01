<?php

namespace IpStoreBundle\Tests\Service;

use IpStoreBundle\Service\MySQLDriver;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class MySQLDriverTest extends KernelTestCase
{
    public function testQValidation()
    {
        self::bootKernel();

        $someService = static::$kernel
            ->getContainer()
            ->get(MySQLDriver::class);


        $result = $someService->validation('127.0.0.1');

        $this->assertEquals(null, $result);
    }

    public function testAdd()
    {
        self::bootKernel();

        $someService = static::$kernel
            ->getContainer()
            ->get(MySQLDriver::class);

        $result = $someService->add('127.0.0.1');

        $this->assertInternalType('int', $result);
    }

    public function testQuery()
    {
        self::bootKernel();

        $someService = static::$kernel
            ->getContainer()
            ->get(MySQLDriver::class);

        $result = $someService->query('127.0.0.1');

        $this->assertInternalType('int', $result);
    }
}