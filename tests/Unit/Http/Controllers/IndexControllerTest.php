<?php

namespace Http\Controllers;

use App\Http\Controllers\IndexController;
use Tests\TestCase;

class IndexControllerTest extends TestCase
{
    public function testWelcome() {
        $response = $this->get('/');
        $response->assertStatus(200)
            ->assertViewIs('welcome');
    }
}
