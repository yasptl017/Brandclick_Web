<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateAdminPasswordRequest;
use App\Http\Requests\UpdateAdminUsernameRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class AdminAccountController extends Controller
{
    public function edit(): View
    {
        return view('admin.account-settings');
    }

    public function updateUsername(UpdateAdminUsernameRequest $request): RedirectResponse
    {
        $request->user()->update([
            'name' => $request->validated('username'),
        ]);

        return to_route('admin.account.edit')
            ->with('username_status', 'Admin ID updated.');
    }

    public function updatePassword(UpdateAdminPasswordRequest $request): RedirectResponse
    {
        $request->user()->update([
            'password' => $request->validated('password'),
        ]);

        return to_route('admin.account.edit')
            ->with('password_status', 'Password updated.');
    }
}
