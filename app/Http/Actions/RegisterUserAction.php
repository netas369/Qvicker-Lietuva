<?php

namespace App\Http\Actions;

use App\Models\User;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class RegisterUserAction
{
    public function execute(array $personalData, array $categoryData = [], string $userRole = 'seeker'): User
    {
        $birthDate = $this->formatBirthDate($personalData['gimimo_data']);
        $phone = $this->formatPhone($personalData['phone']);
        $cities = $this->formatCities($personalData['miestas']);

        $user = User::create([
            'name' => ucfirst(strtolower($personalData['vardas'])),
            'lastname' => ucfirst(strtolower($personalData['pavarde'])),
            'birthday' => $birthDate,
            'email' => $personalData['email'],
            'cities' => $cities,
            'phone' => $phone,
            'address' => $personalData['adresas'],
            'postal_code' => $personalData['post_code'],
            'gender' => $personalData['gender'],
            'languages' => json_encode($personalData['languages']),
            'password' => bcrypt($personalData['slaptazodis']),
            'role' => $userRole,
        ]);

        if ($userRole === 'provider' && !empty($categoryData['selectedSubcategories'])) {
            $this->attachCategories($user, $categoryData);
        }

        event(new \Illuminate\Auth\Events\Registered($user));
        Auth::login($user);

        return $user;
    }

    private function formatBirthDate(string $date): string
    {
        try {
            return Carbon::parse($date)->format('Y-m-d');
        } catch (\Exception $e) {
            throw new \InvalidArgumentException('Neteisingas datos formatas.');
        }
    }

    private function formatPhone(string $phone): string
    {
        return '+370' . $phone;
    }

    private function formatCities($cities): array
    {
        return is_array($cities) ? $cities : [$cities];
    }

    private function attachCategories(User $user, array $categoryData): void
    {
        $pivotData = [];

        foreach ($categoryData['selectedSubcategories'] as $subcategoryId) {
            $pivotData[$subcategoryId] = [
                'price' => $categoryData['subcategoryPrices'][$subcategoryId] ?? null,
                'type' => $categoryData['subcategoryPriceTypes'][$subcategoryId] ?? null,
                'experience' => $categoryData['subcategoryExperience'][$subcategoryId] ?? null,
            ];
        }

        $user->categories()->attach($pivotData);
    }
}
