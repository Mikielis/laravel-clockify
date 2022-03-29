<?php

namespace Tests\Unit;

use App\Services\Client\Country;
use PHPUnit\Framework\TestCase;

class CountriesListTest extends TestCase
{
    use Country;

    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_list_not_empty()
    {
        $this->assertIsArray($this->getCountries());
        $this->assertNotEmpty($this->getCountries());
    }
}
