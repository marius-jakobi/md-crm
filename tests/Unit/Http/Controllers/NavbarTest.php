<?php

namespace Tests\Unit\Http\Controllers;

use App\Models\User;
use Tests\TestCase;

class NavbarTest extends TestCase
{
    private const DASHBOARD = 'Dashboard';
    private const HOMEPAGE = 'Startseite';

    public function testNavbar()
    {
        $this->get('/')
            ->assertSeeText([self::HOMEPAGE])
            ->assertDontSeeText(self::DASHBOARD);

        $user = User::factory()->make();

        $this->actingAs($user)
            ->get('/')
            ->assertSeeText(self::DASHBOARD)
            ->assertDontSeeText(self::HOMEPAGE);
    }
}
