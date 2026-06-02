<?php

namespace App\Http\Requests\Student;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreStudentRequest extends FormRequest
{
    /**
     * Allow request authorization.
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

            'admission_number' => [
                'required',
                'string',
                'max:50',
                Rule::unique('students', 'admission_number')
                    ->ignore($this->student)
            ],

            'name' => [
                'required',
                'string',
                'max:255'
            ],

            'stream' => [
                'required',
                'in:Science,Arts'
            ],

            'course' => [
                'required',
                'string',
                'max:100'
            ],

            'semester' => [
                'required',
                'integer',
                'min:1',
                'max:6'
            ],

            'category' => [
                'required',
                'in:GEN,OBC,SC,ST'
            ],

            'email' => [
                'nullable',
                'email'
            ],

            'phone' => [
                'nullable',
                'string',
                'max:20'
            ]
        ];
    }
}