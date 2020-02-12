<?php

namespace ALajusticia\AuthTracker\Tests;

use Illuminate\Support\Facades\Auth;

class SessionTest extends TestCase
{
    public function test_login_is_tracked()
    {
        // Create user
        $user = factory(User::class)->create();

        // Authenticate user to dispatch login event
        Auth::login($user);

        // Check that current login exists
        $currentLogin = $user->logins()
            ->where('session_id', session()->getId())
            ->first();

        $this->assertNotNull($currentLogin);
    }
}