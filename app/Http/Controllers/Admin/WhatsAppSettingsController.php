<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateWhatsAppGroupUrlRequest;
use App\Models\SiteSetting;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class WhatsAppSettingsController extends Controller
{
    public function edit(): View
    {
        return view('admin.whatsapp-settings', [
            'whatsAppGroupUrl' => SiteSetting::whatsappGroupUrl(),
        ]);
    }

    public function update(UpdateWhatsAppGroupUrlRequest $request): RedirectResponse
    {
        SiteSetting::setWhatsAppGroupUrl($request->validated('whatsapp_group_url'));

        return to_route('admin.whatsapp-settings.edit')
            ->with('status', 'WhatsApp group URL updated.');
    }
}
