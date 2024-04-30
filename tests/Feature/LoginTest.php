<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class LoginTest extends TestCase
{

    /** @test */
    public function user_can_login_with_valid_credentials()
    {

        $response = $this->post('/login', [
            'email_or_username' => 'iqbalja', // Assuming email is used for login
            'password' => 'password',
        ]);

        $response->assertRedirect('/dashboard');
    }

    /** @test */
    public function user_cannot_login_with_invalid_credentials()
    {

        $response = $this->post('/login', [
            'email_or_username' => 'user@example.com',
            'password' => 'wrongpassword',
        ]);

        $response->assertSessionHasErrors('email_or_username');
        $this->assertGuest();
    }

    /** @test */
    public function authenticated_user_redirected_to_dashboard()
    {
        $user = User::where('username', 'admin')->first();

        $response = $this->actingAs($user)->get('/login');

        $response->assertRedirect('/home');
    }

    /** @test */
    public function authenticated_admin_redirected_to_admin_dashboard()
    {
        $user = User::factory()->create([
            'email' => 'admin@example.com',
            'username' => 'admin123',
            'password' => bcrypt('adminpassword'),
        ]);
        $user->assignRole('admin'); // Assuming there's a method to assign the admin role

        $response = $this->actingAs($user)->get('/login');

        $response->assertRedirect('/admin/dashboard');
    }
}
