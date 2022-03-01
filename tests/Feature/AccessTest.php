<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AccessTest extends TestCase
{
    /**
     * Unauthenticated user cannot reach following pages
     * @return void
     */
    public function test_cannot_reach_protected_pages(): void
    {
        // Listed some pages with restricted access, expected redirect (status 302)
        $this->get(route('home'))->assertStatus(302);
        $this->get(route('clients'))->assertStatus(302);
        $this->get(route('projects'))->assertStatus(302);
        $this->get(route('timesheet'))->assertStatus(302);
        $this->get(route('userActivities'))->assertStatus(302);
    }
}
