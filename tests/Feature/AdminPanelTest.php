<?php

use App\Models\SiteSetting;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('redirects guests to the admin sign in page', function () {
    $response = $this->get(route('admin.dashboard'));

    $response->assertRedirect(route('login'));
});

test('signs in an administrator with their admin ID and password', function () {
    $admin = User::factory()->create([
        'name' => 'admin',
        'password' => 'admin',
        'is_admin' => true,
    ]);

    $response = $this->post(route('admin.login.store'), [
        'username' => 'admin',
        'password' => 'admin',
    ]);

    $response->assertRedirect(route('admin.dashboard'));
    $this->assertAuthenticatedAs($admin);
});

test('forbids a non-administrator from the admin panel', function () {
    $user = User::factory()->create();

    $response = $this->actingAs($user)->get(route('admin.dashboard'));

    $response->assertForbidden();
});

test('updates the WhatsApp group URL for the public short link', function () {
    $admin = User::factory()->create(['is_admin' => true]);

    $response = $this->actingAs($admin)->put(route('admin.whatsapp-settings.update'), [
        'whatsapp_group_url' => 'https://chat.whatsapp.com/new-group-invite',
    ]);

    $response->assertRedirect(route('admin.whatsapp-settings.edit'));
    $this->assertDatabaseHas('site_settings', [
        'key' => SiteSetting::WhatsAppGroupUrl,
        'value' => 'https://chat.whatsapp.com/new-group-invite',
    ]);
    $this->get(route('go.whatsapp'))
        ->assertRedirect('https://chat.whatsapp.com/new-group-invite');
});

test('rejects WhatsApp URLs outside the official group invite domain', function () {
    $admin = User::factory()->create(['is_admin' => true]);

    $response = $this->actingAs($admin)->put(route('admin.whatsapp-settings.update'), [
        'whatsapp_group_url' => 'https://example.com/not-a-whatsapp-group',
    ]);

    $response->assertSessionHasErrors('whatsapp_group_url');
    $this->assertDatabaseMissing('site_settings', [
        'key' => SiteSetting::WhatsAppGroupUrl,
    ]);
});
