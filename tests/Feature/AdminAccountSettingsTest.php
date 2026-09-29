<?php

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;

uses(RefreshDatabase::class);

test('updates the Admin ID after verifying the current password', function () {
    $admin = User::factory()->create([
        'name' => 'admin',
        'password' => 'admin',
        'is_admin' => true,
    ]);

    $response = $this->actingAs($admin)->put(route('admin.account.username.update'), [
        'username' => 'brandclick-admin',
        'current_password' => 'admin',
    ]);

    $response->assertRedirect(route('admin.account.edit'));
    $this->assertDatabaseHas('users', [
        'id' => $admin->id,
        'name' => 'brandclick-admin',
    ]);
});

test('updates the password after verifying the current password', function () {
    $admin = User::factory()->create([
        'password' => 'current-password',
        'is_admin' => true,
    ]);

    $response = $this->actingAs($admin)->put(route('admin.account.password.update'), [
        'current_password' => 'current-password',
        'password' => 'new-secure-password',
        'password_confirmation' => 'new-secure-password',
    ]);

    $response->assertRedirect(route('admin.account.edit'));
    expect(Hash::check('new-secure-password', $admin->fresh()->password))->toBeTrue();
});

test('rejects a duplicate Admin ID', function () {
    $admin = User::factory()->create([
        'password' => 'current-password',
        'is_admin' => true,
    ]);
    User::factory()->create(['name' => 'taken-admin-id']);

    $response = $this->actingAs($admin)->put(route('admin.account.username.update'), [
        'username' => 'taken-admin-id',
        'current_password' => 'current-password',
    ]);

    $response->assertSessionHasErrors([
        'username' => 'The username has already been taken.',
    ]);
    $this->assertDatabaseHas('users', [
        'id' => $admin->id,
        'name' => $admin->name,
    ]);
});

test('rejects a password update when the current password is incorrect', function () {
    $admin = User::factory()->create([
        'password' => 'current-password',
        'is_admin' => true,
    ]);

    $response = $this->actingAs($admin)->put(route('admin.account.password.update'), [
        'current_password' => 'incorrect-password',
        'password' => 'new-secure-password',
        'password_confirmation' => 'new-secure-password',
    ]);

    $response->assertSessionHasErrors([
        'current_password' => 'The password is incorrect.',
    ]);
    expect(Hash::check('current-password', $admin->fresh()->password))->toBeTrue();
});
