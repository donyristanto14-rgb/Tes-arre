<?php

namespace Tests\Feature\Auth;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AuthenticationTest extends TestCase
{
    use RefreshDatabase;

    public function test_login_screen_can_be_rendered(): void
    {
        $response = $this->get('/login');

        $response->assertOk()
            ->assertSee('id="toggle-password"', false)
            ->assertSee('Tampilkan password')
            ->assertSee("passwordInput.type = isVisible ? 'password' : 'text'", false);
    }

    public function test_guest_redirect_uses_forwarded_codespaces_host_and_https_scheme(): void
    {
        $this->withServerVariables([
            'HTTP_HOST' => 'localhost:8000',
            'REMOTE_ADDR' => '10.0.0.1',
            'HTTP_X_FORWARDED_HOST' => 'codespace-8000.app.github.dev',
            'HTTP_X_FORWARDED_PROTO' => 'https',
        ])->get('/products')
            ->assertRedirect('https://codespace-8000.app.github.dev/login');
    }

    public function test_users_can_authenticate_using_the_login_screen(): void
    {
        $user = User::factory()->create();

        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => 'password',
        ]);

        $this->assertAuthenticated();
        $response->assertRedirect(route('dashboard', absolute: false));
    }

    public function test_authenticated_pages_log_out_on_browser_refresh_and_are_not_cached(): void
    {
        $response = $this->actingAs(User::factory()->create())
            ->get(route('dashboard'));

        $response->assertOk()
            ->assertSee("navigationEntry?.type === 'reload'", false)
            ->assertSee('logoutForm.action', false)
            ->assertSee('logoutForm.submit()', false);

        $this->assertStringContainsString('no-store', $response->headers->get('Cache-Control'));
    }

    public function test_users_can_not_authenticate_with_invalid_password(): void
    {
        $user = User::factory()->create();

        $this->post('/login', [
            'email' => $user->email,
            'password' => 'wrong-password',
        ]);

        $this->assertGuest();
    }

    public function test_users_can_logout(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->post('/logout');

        $this->assertGuest();
        $response->assertRedirect('/login');
    }
}
