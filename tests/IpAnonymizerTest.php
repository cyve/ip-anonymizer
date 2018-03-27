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
    }
}
