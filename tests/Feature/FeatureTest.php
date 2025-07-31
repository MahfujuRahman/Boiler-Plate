<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class FeatureTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_example(): void
    {
        $this->assertTrue(true);
    }

    public function test_user_can_login_with_correct_credentials()
    {
        $user = User::factory()->create([
            'password' => bcrypt('password123')
        ]);

        // Ensure authentication routes are loaded for testing
        if (app()->routesAreCached() === false && method_exists($this, 'withoutExceptionHandling')) {
            $this->withoutExceptionHandling();
        }

        $loginRoute = route('login'); // Use named route if available

        $response = $this->post($loginRoute, [
            'email' => $user->email,
            'password' => 'password123',
        ]);

        // Adjust the redirect path if your app redirects elsewhere after login
        $response->assertRedirect('/home');
        $this->assertAuthenticatedAs($user);
    }
}
