<?php

namespace App\Http\Requests;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateWhatsAppGroupUrlRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return $this->user()?->can('access-admin') ?? false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'whatsapp_group_url' => [
                'required',
                'string',
                'max:2048',
                'url',
                function (string $attribute, mixed $value, Closure $fail): void {
                    $host = parse_url((string) $value, PHP_URL_HOST);

                    if ($host !== 'chat.whatsapp.com') {
                        $fail('The WhatsApp group URL must be a chat.whatsapp.com link.');
                    }
                },
            ],
        ];
    }
}
