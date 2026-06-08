<?php

namespace App\Http\Requests\Notification;

use Illuminate\Foundation\Http\FormRequest;

class StoreNotificationRequest extends FormRequest
{
    /**
     * Determine if the user is authorized.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Validation rules.
     */
    public function rules(): array
    {
        return [

            'type' => 'required|in:SMS,EMAIL,WHATSAPP',

            'recipient' => 'required',

            'message' => 'required'

        ];
    }
}