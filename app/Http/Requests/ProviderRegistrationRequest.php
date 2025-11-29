<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Carbon;

class ProviderRegistrationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $minBirthDate = Carbon::now()->subYears(14)->format('Y-m-d');
        $maxBirthDate = Carbon::now()->subYears(100)->format('Y-m-d');

        return [
            'vardas' => 'required|string|max:255',
            'pavarde' => 'required|string|max:255',
            'gimimo_data' => [
                'required',
                'date',
                'before_or_equal:' . $minBirthDate,
                'after_or_equal:' . $maxBirthDate,
                'date_format:Y-m-d',
            ],
            'email' => 'required|email|unique:users,email',
            'miestas' => 'required|string|max:255',
            'adresas' => 'required|string|max:255',
            'phone' => 'required|string|regex:/^6[0-9]{7}$/',
            'post_code' => 'required|string|max:6',
            'slaptazodis' => 'required|string|min:8|confirmed',
            'gender' => 'required|in:male,female,other',
            'languages' => 'required|array|min:1',
            'selectedSubcategories' => 'required|array|min:1',
            'subcategoryPrices.*' => 'required|numeric|min:0|max:1000',
            'subcategoryPriceTypes.*' => 'required|in:hourly,fixed,meter',
            'subcategoryExperience.*' => 'nullable|integer|min:0|max:50',
            'terms' => 'required|accepted',
        ];
    }

    public function messages(): array
    {
        return [
            'vardas.required' => 'Vardas yra privalomas.',
            'pavarde.required' => 'Pavardė yra privaloma.',
            'email.unique' => 'Toks el. paštas jau užregistruotas.',
            'phone.regex' => 'Telefono numeris turi prasidėti skaitmeniu 6 ir būti 8 skaitmenų ilgio.',
            'languages.min' => 'Privaloma pasirinkti bent vieną kalbą',
            'selectedSubcategories.min' => 'Privaloma pasirinkti bent vieną kategoriją',
            'terms.accepted' => 'Privalote sutikti su naudojimo sąlygomis.',
        ];
    }
}
