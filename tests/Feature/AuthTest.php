<?php

namespace Tests\Feature;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class AuthTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_redirect_if_not_authenticate()
    {
        $response = $this->get('/');
        $response->assertRedirect('login');
    }

    public function test_user_can_view_login_page()
    {
        $response = $this->get('login');
        $response->assertSeeTextInOrder(['Sign In To Preta', 'Sign In']);
    }

    public function test_user_can_login_with_correct_credential()
    {
        $user = factory(User::class)->make();
        $response = $this->post(route('login'), [
            'email' => $user->email,
            'password' => 'password'
        ]);

        $response->assertRedirect('/');
    }

    public function test_user_can_logout()
    {
        $user = factory(User::class)->create();
        $response = $this->actingAs($user)->from('/')->post(route('logout'));
        $this->followRedirects($response)->assertSeeText('Sign In');
    }

    public function test_user_can_use_remember_feature()
    {
        $user = factory(User::class)->create();
        $response = $this->from(route('login'))->post(route('login'), [
            'email' => $user->email,
            'password' => 'password',
            'remember' => 'on'
        ]);

        $response->assertCookie(Auth::guard()->getRecallerName(), vsprintf('%s|%s|%s', [
            $user->id,
            $user->getRememberToken(),
            $user->password,
        ]));

        $this->assertAuthenticatedAs($user);
    }

    public function test_user_cannot_login_with_wrong_credential()
    {
        $response = $this->from(route('login'))->post(route('login'), [
            'email' => 'random@ema.il',
            'password' => 'password',
        ]);

        $response->assertRedirect('/login');
        $response->assertSessionHasErrors('email');
        $this->assertTrue(session()->hasOldInput('email'));
        $this->assertFalse(session()->hasOldInput('password'));
        $this->assertGuest();
    }

    public function test_user_can_see_name_after_login()
    {
        $user = factory(User::class)->make();
        $response = $this->actingAs($user)->get('/');

        $response->assertSeeText($user->name);
    }
}
