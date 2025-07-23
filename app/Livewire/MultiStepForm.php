<?php

namespace App\Livewire;

use App\Models\Category;
use App\Models\User;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class MultiStepForm extends Component
{
    public $currentStep = 2;

    public $totalSteps = 3;

    public $userType;

    //step 1 fields
    public $vardas;

    public $pavarde;

    public $gimimo_data;

    public $email;

    public $miestas;

    public $adresas;

    public $post_code;

    public $phone;

    public $slaptazodis;

    public $slaptazodis_confirmation;

    public $selectedSubcategories = [];

    public $categories;

    public $gender;

    public $languages = [];

    public $selectedLanguage = '';

    public $activeTab = 0;

    public $terms = false;

    protected $rules = [
        'terms' => 'required|accepted',
    ];

    public function mount($userType)
    {
        $this->userType = $userType;
        $this->totalSteps = $userType === 'provider' ? 3 : 1;
        $this->loadCategories();

    }

    public function loadCategories()
    {
        $this->categories = Category::all()
            ->groupBy('category')
            ->map(function ($group) {
                return [
                    'name' => $group->first()->category,
                    'subcategories' => $group->map(fn ($item) => [
                        'id' => $item->id, // Include the ID of the subcategory
                        'name' => $item->subcategory,
                    ])->toArray(),
                ];
            })->values();
    }

    public function render()
    {
        return view('livewire.multi-step-form');
    }

    public function nextStep()
    {
        $this->validate($this->getValidationRules());
        $this->currentStep++;
    }

    public function previousStep()
    {
        $this->currentStep--;
    }

    private function getValidationRules()
    {

        if ($this->userType === 'seeker') {
            $minBirthDate = Carbon::now()->subYears(14)->format('Y-m-d');
            $maxBirthDate = Carbon::now()->subYears(100)->format('Y-m-d');

            return [
                'vardas' => 'required|string|max:255',
                'pavarde' => 'required|string|max:255',
                'gimimo_data' => [
                    'required',
                    'date',
                    'before_or_equal:'.$minBirthDate,
                    'after_or_equal:'.$maxBirthDate,
                    'date_format:Y-m-d',
                ],
                'email' => 'required|email|unique:users,email',
                'miestas' => 'required|string|max:255',
                'adresas' => 'required|string|max:255',
                'post_code' => 'required|string|max:6',
                'phone' => 'required|string|regex:/^6[0-9]{7}$/',
                'slaptazodis' => 'required|string|min:8|confirmed',
                'slaptazodis_confirmation' => 'required|string|min:8',
                'gender' => 'required',
                'languages' => 'required|array|min:1',
            ];
        }

        if ($this->currentStep === 1) {
            $minBirthDate = Carbon::now()->subYears(14)->format('Y-m-d');
            $maxBirthDate = Carbon::now()->subYears(100)->format('Y-m-d');

            return [
                'vardas' => 'required|string|max:255',
                'pavarde' => 'required|string|max:255',
                'gimimo_data' => [
                    'required',
                    'date',
                    'before_or_equal:'.$minBirthDate,
                    'after_or_equal:'.$maxBirthDate,
                    'date_format:Y-m-d',
                ],
                'email' => 'required|email|unique:users,email',
                'miestas' => 'required|string|max:255',
                'adresas' => 'required|string|max:255',
                'phone' => 'required|string|regex:/^6[0-9]{7}$/',
                'post_code' => 'required|string|max:6',
                'slaptazodis' => 'required|string|min:8|confirmed',
                'slaptazodis_confirmation' => 'required|string|min:8',
                'gender' => 'required',
                'languages' => 'required|array|min:1',
            ];
        }

        if ($this->currentStep === 2) {
            return [
                'selectedSubcategories' => 'required|array|min:1',
            ];
        }

        if ($this->currentStep === 3) {
            return [
                'terms' => 'required|accepted',
            ];
        }

        return [];
    }

    public function messages()
    {
        return [
            // General rules
            'required' => 'Laukas :attribute yra privalomas.',
            'string' => 'Laukas :attribute turi būti tekstinis.',
            'max' => 'Laukas :attribute negali būti ilgesnis nei :max simbolių.',
            'email' => 'Laukas :attribute turi būti teisingo el. pašto formato.',
            'date' => 'Laukas :attribute turi būti teisingos datos formato.',
            'min' => 'Laukas :attribute turi būti bent :min simbolių ilgio.',
            'confirmed' => 'Laukas :attribute patvirtinimas nesutampa.',
            'unique' => 'Toks :attribute jau užregistruotas.',
            'regex' => 'Laukas :attribute neatitinka reikalaujamo formato.',
            'size' => 'Laukas :attribute turi būti :size simbolių ilgio.',
            'date_format' => 'Laukas :attribute turi būti formato :format.',

            // Custom rules
            'gimimo_data.before_or_equal' => 'Jūs turite būti bent 14 metų.',
            'gimimo_data.after_or_equal' => 'Neteisingas gimimo datos formatas. Patikrinkite metus.',
            'gimimo_data.date_format' => 'Neteisingas datos formatas.',
            'phone.regex' => 'Telefono numeris turi prasidėti skaitmeniu 6 ir būti 8 skaitmenų ilgio.',
            'phone.size' => 'Telefono numeris turi būti 8 skaitmenų ilgio.',

            // Field-specific overrides
            'vardas.required' => 'Vardas yra privalomas.',
            'pavarde.required' => 'Pavardė yra privaloma.',
            'gimimo_data.required' => 'Gimimo data yra privaloma.',
            'email.required' => 'El. paštas yra privalomas.',
            'miestas.required' => 'Miestas yra privalomas.',
            'adresas.required' => 'Adresas yra privalomas.',
            'post_code.required' => 'Pašto kodas yra privalomas',
            'gender.required' => 'Lytis yra privaloma',
            'phone.required' => 'Telefono numeris yra privalomas.',
            'slaptazodis.required' => 'Slaptažodis yra privalomas.',
            'slaptazodis_confirmation.required' => 'Slaptažodžio patvirtinimas yra privalomas.',
            'selectedCategories.required' => 'Privaloma pasirinkti bent vieną kategoriją',
            'selectedCategories.min' => 'Privaloma pasirinkti bent vieną kategoriją',
            'languages.required' => 'Privaloma pasirinkti bent vieną kalbą',
            'languages.min' => 'Privaloma pasirinkti bent vieną kalbą',
            'languages.array' => 'Kalbos turi būti pateiktos sąrašu',
            'selectedSubcategories.required' => 'Privaloma pasirinkti bent vieną kategoriją',
            'selectedSubcategories.min' => 'Privaloma pasirinkti bent vieną kategoriją',
            'terms.required' => 'Privalote sutikti su naudojimo sąlygomis.',
            'terms.accepted' => 'Privalote sutikti su naudojimo sąlygomis.',
        ];
    }

    public function validationAttributes()
    {
        return [
            'vardas' => 'vardas',
            'pavarde' => 'pavardė',
            'gimimo_data' => 'gimimo data',
            'email' => 'el. paštas',
            'miestas' => 'miestas',
            'adresas' => 'adresas',
            'post_code' => 'pašto kodas',
            'phone' => 'telefono numeris',
            'slaptazodis' => 'slaptažodis',
            'slaptazodis_confirmation' => 'slaptažodžio patvirtinimas',
            'gender' => 'lytis',
            'languages' => 'kalbos',
        ];
    }

    public function register()
    {
        $this->validate($this->getValidationRules());

        // Determine user role based on user type
        if ($this->userType === 'provider') {
            $userRole = 'provider';
        } elseif ($this->userType === 'seeker') {
            $userRole = 'seeker';
        }

        // Add date formatting to prevent invalid dates
        try {
            $birthDate = Carbon::parse($this->gimimo_data)->format('Y-m-d');
        } catch (\Exception $e) {
            return $this->addError('gimimo_data', 'Neteisingas datos formatas.');
        }

        $formattedPhone = '+370'.$this->phone;

        if (! is_array($this->miestas)) {
            $this->miestas = [$this->miestas]; // Convert single value to array
        }

        // Create new user with safely formatted date
        $user = User::create([
            'name' => ucfirst(strtolower($this->vardas)),
            'lastname' => ucfirst(strtolower($this->pavarde)),
            'birthday' => $birthDate,
            'email' => $this->email,
            'cities' => $this->miestas,
            'phone' => $formattedPhone,
            'address' => $this->adresas,
            'postal_code' => $this->post_code,
            'gender' => $this->gender,
            'languages' => json_encode($this->languages),
            'password' => bcrypt($this->slaptazodis),
            'role' => $userRole,
        ]);

        if ($userRole === 'provider' && !empty($this->selectedSubcategories)) {
            $user->categories()->attach($this->selectedSubcategories);
        }
        // Fire the Registered event - this triggers email verification
        event(new \Illuminate\Auth\Events\Registered($user));

        // Log in the user
        Auth::login($user);

        // Redirect based on user role and email verification status
        if ($user->hasVerifiedEmail()) {
            // If email is already verified (shouldn't happen), go to profile
            return redirect()->route('myprofile');
        } else {
            // If email needs verification, redirect to verification page
            return redirect()->route('verification.notice');
        }
    }

    public function addLanguage()
    {
        if (! empty($this->selectedLanguage) && ! in_array($this->selectedLanguage, $this->languages)) {
            $this->languages[] = $this->selectedLanguage;
            $this->selectedLanguage = ''; // Reset selection
        }
    }

    public function removeLanguage($language)
    {
        $this->languages = array_filter($this->languages, function ($lang) use ($language) {
            return $lang !== $language;
        });
    }

    public function setActiveTab($index)
    {
        $this->activeTab = $index;
    }

    public function removeSubcategory($id)
    {
        $this->selectedSubcategories = array_values(array_filter($this->selectedSubcategories, function ($subcategoryId) use ($id) {
            return $subcategoryId != $id;
        }));
    }
}
