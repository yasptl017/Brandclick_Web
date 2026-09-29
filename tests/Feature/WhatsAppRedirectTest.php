<?php

test('the WhatsApp short URL redirects to the group invite', function () {
    $response = $this->get('/go/whatsapp');

    $response->assertRedirect('https://chat.whatsapp.com/LOMmANNLstK1hbmT38PpzC');
});
