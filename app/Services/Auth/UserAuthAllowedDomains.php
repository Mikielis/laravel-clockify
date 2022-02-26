<?php

namespace App\Services\Auth;

class UserAuthAllowedDomains
{
    static public function check(string $domain): bool
    {
        $domains = explode(',', config('auth.whitelisted_domains'));

        if (count($domains) > 0) {
            return in_array($domain, $domains);
        }

        return false;
    }
}
