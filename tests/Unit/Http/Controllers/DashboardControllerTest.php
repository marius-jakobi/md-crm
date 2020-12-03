<?php

namespace Unit\Http\Controllers;

use App\Models\User;
use Tests\TestCase;

class DashboardControllerTest extends TestCase
{

    public function testShowDashboard()
    {
        // Unauthenticated
        $this->get(route('dashboard'))
            ->assertRedirect(route('auth.login'));

        // create test user
        $user = User::factory()->create();

        // Test authenticated access
        $this->actingAs($user)
            ->get(route('dashboard'))
            ->assertStatus(200)
            ->assertViewIs('dashboard');

        $user->delete();
    }
}
