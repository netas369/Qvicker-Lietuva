<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules;

class SeekerRegistrationRequest extends FormRequest
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
     */
    public function rules(): array
    {
        return [
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'full_name' => ['required', 'string', 'max:255'],
        ];
    }

    /**
     * Get custom messages for validator errors.
     */
    public function messages(): array
    {
        return [
            'email.required' => 'El. paštas yra privalomas.',
            'email.email' => 'El. paštas turi būti teisingo formato.',
            'email.unique' => 'Toks el. paštas jau užregistruotas.',
            'password.required' => 'Slaptažodis yra privalomas.',
            'password.confirmed' => 'Slaptažodžio patvirtinimas nesutampa.',
            'full_name.required' => 'Vardas ir pavardė yra privalomi.',
        ];
    }

    /**
     * Get custom attributes for validator errors.
     */
    public function attributes(): array
    {
        return [
            'email' => 'el. paštas',
            'password' => 'slaptažodis',
            'full_name' => 'vardas ir pavardė',
        ];
    }
}
