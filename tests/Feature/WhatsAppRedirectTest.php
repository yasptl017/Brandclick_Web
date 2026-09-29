<?php

use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('the WhatsApp short URL redirects to the default group invite', function () {
    $response = $this->get('/go/whatsapp');

    $response->assertRedirect('https://chat.whatsapp.com/LOMmANNLstK1hbmT38PpzC');
});
