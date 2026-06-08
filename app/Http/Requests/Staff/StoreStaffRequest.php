<?php

namespace App\Http\Requests\Staff;

use Illuminate\Foundation\Http\FormRequest;

class StoreStaffRequest extends FormRequest
{
    /**
     * Allow request authorization
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Validation rules for staff creation
     */
    public function rules(): array
    {
        return [

            // Staff name
            'name' => [
                'required',
                'string',
                'max:255'
            ],

            // TEACHING or NON_TEACHING
            'type' => [
                'required',
                'in:TEACHING,NON_TEACHING'
            ],

            // Subject optional for teaching staff
            'subject' => [
                'nullable',
                'string',
                'max:255'
            ],

            // Role optional for non-teaching staff
            'role' => [
                'nullable',
                'string',
                'max:255'
            ],

            // Monthly salary
            'salary' => [
                'required',
                'numeric',
                'min:0'
            ],

            // Optional email
            'email' => [
                'nullable',
                'email'
            ],

            // Optional phone
            'phone' => [
                'nullable',
                'string',
                'max:20'
            ]
        ];
    }
}