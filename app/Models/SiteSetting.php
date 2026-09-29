<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SiteSetting extends Model
{
    public const DefaultWhatsAppGroupUrl = 'https://chat.whatsapp.com/LOMmANNLstK1hbmT38PpzC';

    public const WhatsAppGroupUrl = 'whatsapp_group_url';

    /**
     * @var array<int, string>
     */
    protected $fillable = [
        'key',
        'value',
    ];

    public static function whatsappGroupUrl(): string
    {
        return static::query()
            ->where('key', self::WhatsAppGroupUrl)
            ->value('value') ?? self::DefaultWhatsAppGroupUrl;
    }

    public static function setWhatsAppGroupUrl(string $whatsAppGroupUrl): void
    {
        static::query()->updateOrCreate(
            ['key' => self::WhatsAppGroupUrl],
            ['value' => $whatsAppGroupUrl],
        );
    }
}
