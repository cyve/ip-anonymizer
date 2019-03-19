<?php

namespace Cyve\IpAnonymizer;

class IpAnonymizer
{
    /**
     * @var string
     */
    const IPV4_NETMASK = '255.255.255.0';

    /**
     * @var string
     */
    const IPV6_NETMASK = 'ffff:ffff:ffff:ffff:0000:0000:0000:0000';

    public function anonymize(string $ip): string
    {
        $ip = str_ireplace('x', '0', $ip);

        if(filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4)) {
            return $this->anonymizeIPv4($ip);
        }

        if(filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_IPV6)) {
            return $this->anonymizeIPv6($ip);
        }

        throw new \InvalidArgumentException(sprintf('"%s" is not a valid IP address', $ip));
    }
    
    private function anonymizeIPv4(string $ip): string
    {
        if(filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_NO_PRIV_RANGE|FILTER_FLAG_NO_RES_RANGE)) {
            return inet_ntop(inet_pton($ip) & inet_pton(static::IPV4_NETMASK));
        }

        return $ip;
    }

    private function anonymizeIPv6(string $ip): string
    {
        if(filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_NO_PRIV_RANGE|FILTER_FLAG_NO_RES_RANGE)) {
            return inet_ntop(inet_pton($ip) & inet_pton(static::IPV6_NETMASK));
        }

        return $ip;
    }
}
