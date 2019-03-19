<?php

require 'vendor/autoload.php';

use PHPUnit\Framework\TestCase;
use Cyve\IpAnonymizer\IpAnonymizer;

class IpAnonymizerTest extends TestCase
{
    /**
     * @dataProvider ipProvider
     */
    public function testAnonymize($ip, $expected)
    {
        $ipAnonymizer = new IpAnonymizer();
        $this->assertEquals($expected, $ipAnonymizer->anonymize($ip));
    }

    public function ipProvider()
    {
        yield ['123.123.123.123', '123.123.123.0'];
        yield ['123.123.123.x', '123.123.123.0'];
        yield ['123.123.123.X', '123.123.123.0'];
        yield ['192.168.0.1', '192.168.0.1'];
        yield ['127.0.0.1', '127.0.0.1'];
        yield ['1234:1234:1234:1234:1234:1234:1234:1234', '1234:1234:1234:1234::'];
        yield ['fdff:ffff:ffff:ffff:ffff:ffff:ffff:ffff', 'fdff:ffff:ffff:ffff:ffff:ffff:ffff:ffff'];
        yield ['::1', '::1'];
    }

    /**
     * @dataProvider invalidIpProvider
     * @expectedException InvalidArgumentException
     */
    public function testAnonymizeWithInvalidIp($ip)
    {
        $ipAnonymizer = new IpAnonymizer();
        $ipAnonymizer->anonymize($ip);
    }

    public function invalidIpProvider()
    {
        yield ['foo'];
        yield ['1.1.1.1.1'];
        yield ['999.999.999.999'];
    }
}
