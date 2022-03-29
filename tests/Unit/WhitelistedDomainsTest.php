<?php

namespace Tests\Unit;

use App\Services\Auth\UserAuthAllowedDomains;
use Illuminate\Support\Facades\Config;
use Tests\TestCase;

class WhitelistedDomainsTest extends TestCase
{
    protected UserAuthAllowedDomains $allowedDomainsService;

    public function setUp(): void
    {
        parent::setUp(); // TODO: Change the autogenerated stub
        $this->allowedDomainsService = new UserAuthAllowedDomains();
    }

    /**
     * Gmail.com is a whitelisted domain - see phpunit.xml
     * @return void
     */
    public function test_domain_is_whitelisted()
    {
        $this->assertTrue($this->allowedDomainsService->check('gmail.com'));
    }

    /**
     * Test.com isn't a whitelisted domain
     * @return void
     */
    public function test_domain_is_not_whitelisted()
    {
        // Test.com is not whitelisted
        $this->assertFalse($this->allowedDomainsService->check('test.com'));

        //  Check if test.com is still not whitelisted when whitelisted domains list is empty
        config::set('auth.whitelisted_domains', '');
        $this->assertFalse($this->allowedDomainsService->check('test.com'));
    }
}