<?php

use App\Models\User;

test('registration screen can be rendered', function () {
    $response = $this->get('/register');

    $response->assertStatus(200);
});

test('new users can register as super admin', function () {
    $response = $this->post('/register', [
        'name' => 'Super Admin',
        'email' => 'superadmin@koperasi.test',
        'password' => 'password',
        'password_confirmation' => 'password',
    ]);

    $response->assertRedirect(route('login'));
    $response->assertSessionHas('status');

    $this->assertGuest();

    $this->assertDatabaseHas('users', [
        'email' => 'superadmin@koperasi.test',
    ]);

    $user = User::where('email', 'superadmin@koperasi.test')->first();
    expect($user->hasRole('super_admin'))->toBeTrue();
});
