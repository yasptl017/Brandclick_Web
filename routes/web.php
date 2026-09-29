<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::redirect('/go/whatsapp', 'https://chat.whatsapp.com/LOMmANNLstK1hbmT38PpzC')
    ->name('go.whatsapp');
