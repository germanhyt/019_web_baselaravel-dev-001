<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'field_name' => ['required', function ($attribute, $value, $fail) {
                if ($value != 'expected_value') {
                    $fail($attribute . ' is invalid.');
                }
            }],
            'name' => "required",
            'email' => "required",
            'password' => "required"
            // 'password' => [
            //     "required",
            //     Password::min(8)
            //         ->letters()
            // ]
        ];
    }
}
