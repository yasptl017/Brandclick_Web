<?php

use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\WhatsAppSettingsController;
use App\Models\SiteSetting;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/go/whatsapp', function () {
    return redirect()->away(SiteSetting::whatsappGroupUrl());
})->name('go.whatsapp');

Route::middleware('guest')->group(function (): void {
    Route::get('/admin/login', [AdminAuthController::class, 'create'])->name('login');
    Route::post('/admin/login', [AdminAuthController::class, 'store'])
        ->middleware('throttle:admin-login')
        ->name('admin.login.store');
});

Route::middleware(['auth', 'can:access-admin'])->prefix('admin')->name('admin.')->group(function (): void {
    Route::get('/', [AdminDashboardController::class, 'index'])->name('dashboard');
    Route::get('/whatsapp-settings', [WhatsAppSettingsController::class, 'edit'])
        ->name('whatsapp-settings.edit');
    Route::put('/whatsapp-settings', [WhatsAppSettingsController::class, 'update'])
        ->name('whatsapp-settings.update');
    Route::post('/logout', [AdminAuthController::class, 'destroy'])->name('logout');
});
