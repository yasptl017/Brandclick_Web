<?php

namespace Database\Seeders;

use App\Models\SiteSetting;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $admin = User::query()->firstOrCreate([
            'email' => 'admin@brandclick.in',
        ], [
            'name' => 'admin',
            'password' => Hash::make('admin'),
        ]);

        if (! $admin->is_admin) {
            $admin->forceFill(['is_admin' => true])->save();
        }

        SiteSetting::query()->firstOrCreate([
            'key' => SiteSetting::WhatsAppGroupUrl,
        ], [
            'value' => SiteSetting::DefaultWhatsAppGroupUrl,
        ]);
    }
}
