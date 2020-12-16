<?php

namespace Tests\Unit\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Tests\TestCase;

class AuthControllerTest extends TestCase
{
    public function testShowLoginForm() : void {
        $this->get(route('auth.login'))
            ->assertStatus(200)
            ->assertViewIs('auth.login');
    }

    public function testShowSignupForm() : void {
        $this->get(route('auth.signup'))
            ->assertStatus(200)
            ->assertViewIs('auth.signup');
    }

    public function testLoginRequiredFields() : void {
        $this->post(route('auth.authenticate'), ['email' => null, 'password' => null])
            ->assertRedirect(route('auth.login'))
            ->assertSessionHasErrors(['email', 'password']);
    }

    public function testLoginInvalidEMail() : void {
        $this->post(route('auth.authenticate'), ['email' => 'foobar', 'password' => 'foobar'])
            ->assertRedirect(route('auth.login'))
            ->assertSessionHasErrors(['email']);
    }

    public function testLoginInvalidCredentials() : void {
        // Invalid mail address
        $this->post(route('auth.authenticate'), ['email' => 'not-a-actual-user@test.local', 'password' => 'password'])
            ->assertRedirect(route('auth.login'))
            ->assertSessionHas('error');

        $user = $this->createTestUser();

        // Invalid password
        $this->post(route('auth.authenticate'), ['email' => $user->email, 'password' => 'the-wrong-password'])
            ->assertRedirect(route('auth.login'))
            ->assertSessionHas('error');

        $user->delete();
    }

    public function testLoginValidCredentials() : void {
        // create test user
        $user = $this->createTestUser();

        // Attempt with test user data
        $this->post(route('auth.authenticate'), ['email' => $user->email, 'password' => 'password'])
            ->assertRedirect(route('dashboard'));

        // Delete user afterwards
        $user->delete();
    }

    public function testLogout() : void {
        $this->post(route('auth.logout'))
            ->assertRedirect(route('welcome'))
            ->assertSessionHas('success');
    }

    public function testInvalidRegistration() {
        $invalidData = [
            [
                'email' => 'non-valid-email-address',
                'firstname' => 'a',
                'lastname' => 'a',
                'password' => '1234567'
            ],
        ];

        foreach($invalidData as $data) {
            $this->post(route('auth.register'), $data)
                ->assertRedirect(route('auth.signup'))
                ->assertSessionHasErrors(['email', 'firstname', 'lastname', 'password']);
        }
    }

    public function testUniqueEmailRegistration() {
        // Test user to test unique emails
        $user = $this->createTestUser();

        // Request with non-unique email address and missing all other parameters
        $this->post(route('auth.register'), ['email' => $user->email])
            ->assertRedirect(route('auth.signup'))
            ->assertSessionHasErrors(['email', 'firstname', 'lastname', 'password']);

        $user->delete();
    }

    public function testValidRegistration() {
        $faker = \Faker\Factory::create();

        $validData = [
            [
                'email' => $faker->email,
                'firstname' => $faker->firstName,
                'lastname' => $faker->lastName,
                'password' => 'password'
            ],
        ];

        foreach($validData as $data) {
            $this->post(route('auth.register'), $data)
                ->assertRedirect(route('welcome'))
                ->assertSessionHas('success');
        }

        foreach($validData as $user) {
            DB::table('users')->where('email', $user['email'])->delete();
        }
    }

    /**
     * Create test user in database
     *
     * @return User
     */
    private function createTestUser() : User {
        $user = User::factory()->make();
        $user->password = Hash::make('password');
        $user->save();

        return $user;
    }
}
