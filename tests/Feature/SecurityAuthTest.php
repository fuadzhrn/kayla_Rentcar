<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SecurityAuthTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test: Mencegah script injection pada email login
     */
    public function test_prevent_script_injection_on_login_email()
    {
        $response = $this->post('/login', [
            'email' => '<script>alert("XSS")</script>@test.com',
            'password' => 'password123'
        ]);

        $response->assertSessionHasErrors(['email']);
    }

    /**
     * Test: Mencegah SQL injection pada login
     */
    public function test_prevent_sql_injection_on_login()
    {
        $response = $this->post('/login', [
            'email' => 'admin@test.com\'; DROP TABLE users; --',
            'password' => 'password123'
        ]);

        $response->assertSessionHasErrors(['email']);
    }

    /**
     * Test: Email format validation
     */
    public function test_invalid_email_format_on_login()
    {
        $response = $this->post('/login', [
            'email' => 'not-an-email',
            'password' => 'password123'
        ]);

        $response->assertSessionHasErrors(['email']);
    }

    /**
     * Test: Password minimal requirement pada login
     */
    public function test_password_minimum_length_on_login()
    {
        $response = $this->post('/login', [
            'email' => 'admin@test.com',
            'password' => '12345'
        ]);

        $response->assertSessionHasErrors(['password']);
    }

    /**
     * Test: Mencegah script injection pada name register
     */
    public function test_prevent_script_injection_on_register_name()
    {
        $response = $this->post('/register', [
            'name' => 'John<script>alert("XSS")</script>',
            'email' => 'john@test.com',
            'password' => 'MyPassword123@',
            'password_confirmation' => 'MyPassword123@'
        ]);

        $response->assertSessionHasErrors(['name']);
    }

    /**
     * Test: Invalid karakter pada name register
     */
    public function test_invalid_characters_on_register_name()
    {
        $response = $this->post('/register', [
            'name' => 'John; DROP TABLE',
            'email' => 'john@test.com',
            'password' => 'MyPassword123@',
            'password_confirmation' => 'MyPassword123@'
        ]);

        $response->assertSessionHasErrors(['name']);
    }

    /**
     * Test: Weak password pada register
     */
    public function test_weak_password_on_register()
    {
        $response = $this->post('/register', [
            'name' => 'John Doe',
            'email' => 'john@test.com',
            'password' => 'password123',
            'password_confirmation' => 'password123'
        ]);

        $response->assertSessionHasErrors(['password']);
    }

    /**
     * Test: Password harus mengandung huruf besar
     */
    public function test_password_must_contain_uppercase()
    {
        $response = $this->post('/register', [
            'name' => 'John Doe',
            'email' => 'john@test.com',
            'password' => 'mypassword123@',
            'password_confirmation' => 'mypassword123@'
        ]);

        $response->assertSessionHasErrors(['password']);
    }

    /**
     * Test: Password harus mengandung angka
     */
    public function test_password_must_contain_number()
    {
        $response = $this->post('/register', [
            'name' => 'John Doe',
            'email' => 'john@test.com',
            'password' => 'MyPassword@',
            'password_confirmation' => 'MyPassword@'
        ]);

        $response->assertSessionHasErrors(['password']);
    }

    /**
     * Test: Password harus mengandung simbol
     */
    public function test_password_must_contain_symbol()
    {
        $response = $this->post('/register', [
            'name' => 'John Doe',
            'email' => 'john@test.com',
            'password' => 'MyPassword123',
            'password_confirmation' => 'MyPassword123'
        ]);

        $response->assertSessionHasErrors(['password']);
    }

    /**
     * Test: Password confirmation harus cocok
     */
    public function test_password_confirmation_must_match()
    {
        $response = $this->post('/register', [
            'name' => 'John Doe',
            'email' => 'john@test.com',
            'password' => 'MyPassword123@',
            'password_confirmation' => 'DifferentPassword123@'
        ]);

        $response->assertSessionHasErrors(['password']);
    }

    /**
     * Test: Email harus unik pada register
     */
    public function test_email_must_be_unique_on_register()
    {
        User::factory()->create([
            'email' => 'john@test.com'
        ]);

        $response = $this->post('/register', [
            'name' => 'John Doe',
            'email' => 'john@test.com',
            'password' => 'MyPassword123@',
            'password_confirmation' => 'MyPassword123@'
        ]);

        $response->assertSessionHasErrors(['email']);
    }

    /**
     * Test: Registrasi berhasil dengan password valid
     */
    public function test_successful_registration_with_valid_data()
    {
        $response = $this->post('/register', [
            'name' => 'John Doe',
            'email' => 'john@test.com',
            'password' => 'MyPassword123@',
            'password_confirmation' => 'MyPassword123@'
        ]);

        $response->assertRedirect('/login');
        $response->assertSessionHas('success');
        
        $this->assertDatabaseHas('users', [
            'email' => 'john@test.com',
            'name' => 'John Doe'
        ]);
    }

    /**
     * Test: Login berhasil dengan credentials benar
     */
    public function test_successful_login_with_correct_credentials()
    {
        $user = User::factory()->create([
            'email' => 'admin@test.com',
            'password' => bcrypt('MyPassword123@')
        ]);

        $response = $this->post('/login', [
            'email' => 'admin@test.com',
            'password' => 'MyPassword123@'
        ]);

        $response->assertRedirect('/admin/dashboard');
        $this->assertAuthenticatedAs($user);
    }

    /**
     * Test: Login gagal dengan password salah
     */
    public function test_login_failed_with_wrong_password()
    {
        User::factory()->create([
            'email' => 'admin@test.com',
            'password' => bcrypt('MyPassword123@')
        ]);

        $response = $this->post('/login', [
            'email' => 'admin@test.com',
            'password' => 'WrongPassword123@'
        ]);

        $response->assertSessionHasErrors(['email']);
        $this->assertGuest();
    }

    /**
     * Test: Rate limiting pada login (5 percobaan dalam 15 menit)
     */
    public function test_login_rate_limiting()
    {
        // Simulate 5 failed login attempts
        for ($i = 0; $i < 5; $i++) {
            $this->post('/login', [
                'email' => 'admin@test.com',
                'password' => 'WrongPassword'
            ]);
        }

        // 6th attempt should be throttled
        $response = $this->post('/login', [
            'email' => 'admin@test.com',
            'password' => 'WrongPassword'
        ]);

        $response->assertStatus(429);
        $response->assertSessionHasErrors(['email']);
    }

    /**
     * Test: CSRF token required pada login
     */
    public function test_csrf_token_required_on_login()
    {
        $response = $this->withoutToken()->post('/login', [
            'email' => 'admin@test.com',
            'password' => 'MyPassword123@'
        ]);

        $response->assertStatus(419);
    }

    /**
     * Test: Session regeneration after successful login
     */
    public function test_session_regeneration_after_login()
    {
        $oldSessionId = session()->getId();

        $user = User::factory()->create([
            'email' => 'admin@test.com',
            'password' => bcrypt('MyPassword123@')
        ]);

        $this->post('/login', [
            'email' => 'admin@test.com',
            'password' => 'MyPassword123@'
        ]);

        $newSessionId = session()->getId();
        
        // Session ID should be different after login
        $this->assertNotEquals($oldSessionId, $newSessionId);
    }

    /**
     * Test: Logout invalidates session
     */
    public function test_logout_invalidates_session()
    {
        $user = User::factory()->create();

        $this->actingAs($user)
            ->post('/logout')
            ->assertRedirect('/');

        $this->assertGuest();
    }
}
