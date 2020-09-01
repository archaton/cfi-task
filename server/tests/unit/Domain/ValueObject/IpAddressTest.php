<?php

declare(strict_types=1);

namespace Cfi\Domain\ValueObject;

use PHPUnit\Framework\TestCase;

class IpAddressTest extends TestCase
{

    public function test__toString()
    {
        $value = '127.0.0.1';
        $ip = new IpAddress($value);

        $this->assertSame($value, $ip->__toString());
    }

    public function testEquals()
    {
        $value = '127.0.0.1';
        $ip = new IpAddress($value);
        $ip2 = new IpAddress($value);
        $ip3 = new IpAddress('192.168.1.1');

        $this->assertTrue($ip->equals($ip2));
        $this->assertFalse($ip->equals($ip3));
    }
}
