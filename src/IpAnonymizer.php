<?php

namespace Cyve\IpAnonymizer;

class IpAnonymizer
{
    public function anonymize($ip)
    {
        $ip = str_ireplace('x', '0', $ip);

        if(!filter_var($ip, FILTER_VALIDATE_IP)) throw new \InvalidArgumentException('Invalid IP address');

        return inet_ntop(inet_pton($ip) & inet_pton('255.255.255.0'));
    }
}
