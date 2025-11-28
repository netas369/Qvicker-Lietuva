<?php

namespace App\Livewire\Registration;

use Livewire\Component;
use Livewire\Attributes\On;
use App\Models\User;
use App\Models\Category;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\DB;


class RegistrationWizard extends Component
{
    public $userType = 'provider'; // 'provider' or 'seeker'
    public $currentStep = 1;
    public $totalSteps = 3;

    public $personalData = [];
    public $categoryData = [];
    public $categories = [];

    public $terms = false;

    public function mount($userType = 'provider')
    {
        $this->userType = $userType;
        $this->totalSteps = $userType === 'provider' ? 3 : 1;
        $this->loadCategories();
    }

    public function loadCategories()
    {
        $this->categories = Category::select('category', 'subcategory', 'id')
            ->get()
            ->groupBy('category')
            ->map(function ($group, $categoryName) {
                return [
                    'name' => $categoryName,
                    'icon' => '', // You can add icons later if needed
                    'subcategories' => $group->map(function ($item) {
                        return [
                            'id' => $item->id,
                            'name' => $item->subcategory,
                        ];
                    })->toArray(),
                ];
            })
            ->values()
            ->toArray();
    }

    #[On('personal-info-validated')]
    public function handlePersonalInfoValidated($personalData)
    {
        $this->personalData = $personalData;
        $this->currentStep++;
    }

    #[On('category-data-validated')]
    public function handleCategoryDataValidated($categoryData)
    {
        $this->categoryData = $categoryData;
        $this->currentStep++;
    }

    public function nextStep()
    {
        if ($this->currentStep === 1) {
            // Trigger validation on personal info step
            $this->dispatch('trigger-personal-info-submit');
        } elseif ($this->currentStep === 2) {
            // Trigger validation on category selection step
            $this->dispatch('trigger-category-submit');
        }
    }

    public function previousStep()
    {
        if ($this->currentStep > 1) {
            $this->currentStep--;

            // Re-dispatch data to components when going back
            if ($this->currentStep === 1 && !empty($this->personalData)) {
                $this->dispatch('restore-personal-data', personalData: $this->personalData);
            } elseif ($this->currentStep === 2 && !empty($this->categoryData)) {
                $this->dispatch('restore-category-data', categoryData: $this->categoryData);
            }
        }
    }

    #[On('validate-current-step')]
    public function validateCurrentStep()
    {
        if ($this->userType === 'seeker' || ($this->userType === 'provider' && $this->currentStep === 1)) {
            $this->dispatch('trigger-personal-info-submit');
        } elseif ($this->userType === 'provider' && $this->currentStep === 2) {
            $this->dispatch('trigger-category-submit');
        }
    }

    public function register()
    {
        // For seekers, validate personal info first since they skip to register directly
        if ($this->userType === 'seeker' && empty($this->personalData)) {
            // Trigger validation on the personal info step
            $this->dispatch('trigger-personal-info-validation-for-register');
            return;
        }

        // Validate terms
        $this->validate([
            'terms' => 'accepted',
        ], [
            'terms.accepted' => 'Turite sutikti su naudojimo sąlygomis.',
        ]);

        // Create user
        $user = User::create([
            'name' => $this->personalData['vardas'],
            'lastname' => $this->personalData['pavarde'],
            'email' => $this->personalData['email'],
            'password' => Hash::make($this->personalData['slaptazodis']),
            'birthday' => $this->personalData['gimimo_data'],
            'gender' => $this->personalData['gender'],
            'phone' => '+370' . $this->personalData['phone'],
            'cities' => [$this->personalData['miestas']],
            'address' => $this->personalData['adresas'],
            'postal_code' => $this->personalData['post_code'],
            'languages' => $this->personalData['languages'],
            'role' => $this->userType,
        ]);

        // Attach categories for providers using the correct pivot table structure
        if ($this->userType === 'provider' && !empty($this->categoryData['selectedSubcategories'])) {
            foreach ($this->categoryData['selectedSubcategories'] as $subcategoryId) {
                DB::table('user_subcategory')->insert([
                    'user_id' => $user->id,
                    'subcategory_id' => $subcategoryId,
                    'price' => $this->categoryData['subcategoryPrices'][$subcategoryId] ?? 0,
                    'type' => $this->categoryData['subcategoryPriceTypes'][$subcategoryId] ?? 'hourly',
                    'experience' => $this->categoryData['subcategoryExperience'][$subcategoryId] ?? 0,
                ]);
            }
        }

        // Fire registered event and log in
        event(new Registered($user));
        Auth::login($user);

        // Force session regeneration
        request()->session()->regenerate();

        // Redirect using full URL
        return $this->redirect(route('myprofile'), navigate: false);
    }

    public function render()
    {
        return view('livewire.registration.registration-wizard');
    }
}
