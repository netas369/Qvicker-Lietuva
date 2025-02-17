<?php

namespace App\Livewire;

use App\Models\Category;
use Illuminate\Support\Carbon;
use Livewire\Component;

class MultiStepForm extends Component
{
    public $currentStep = 1;
    public $totalSteps = 3;

    //step 1 fields
    public $vardas;
    public $pavarde;
    public $gimimo_data;
    public $email;
    public $miestas;
    public $adresas;
    public $slaptazodis;
    public $slaptazodis_confirmation;

    public $selectedSubcategories = [];
    public $categories;

    protected $rules = [
        'terms' => 'required|accepted',
    ];

    public function mount()
    {
        $this->loadCategories();
    }

    public function loadCategories()
    {
        $this->categories = Category::all()
            ->groupBy('category')
            ->map(function ($group) {
                return [
                    'name' => $group->first()->category,
                    'subcategories' => $group->map(fn($item) => ['name' => $item->subcategory])->toArray()
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
        if ($this->currentStep === 1) {
            $minBirthDate = Carbon::now()->subYears(14)->format('Y-m-d');

            return [
                'vardas' => 'required|string|max:255',
                'pavarde' => 'required|string|max:255',
                'gimimo_data' => ['required', 'date', 'before_or_equal:' . $minBirthDate],
                'email' => 'required|email|unique:users,email',
                'miestas' => 'required|string|max:255',
                'adresas' => 'required|string|max:255',
                'slaptazodis' => 'required|string|min:8|confirmed',
                'slaptazodis_confirmation' => 'required|string|min:8',
            ];
        }

        if ($this->currentStep === 2) {
            return [
                'selectedSubcategories' => 'required|array|min:1',
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

            // Custom rules
            'gimimo_data.before_or_equal' => 'Jūs turite būti bent 14 metų.',

            // Field-specific overrides
            'vardas.required' => 'Vardas yra privalomas.',
            'pavarde.required' => 'Pavardė yra privaloma.',
            'gimimo_data.required' => 'Gimimo data yra privaloma.',
            'email.required' => 'El. paštas yra privalomas.',
            'miestas.required' => 'Miestas yra privalomas.',
            'adresas.required' => 'Adresas yra privalomas.',
            'slaptazodis.required' => 'Slaptažodis yra privalomas.',
            'slaptazodis_confirmation.required' => 'Slaptažodžio patvirtinimas yra privalomas.',
            'selectedCategories.required' => 'Privaloma pasirinkti bent vieną kategoriją',
            'selectedCategories.min' => 'Privaloma pasirinkti bent vieną kategoriją',
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
            'slaptazodis' => 'slaptažodis',
            'slaptazodis_confirmation' => 'slaptažodžio patvirtinimas'
        ];
    }

    public function register()
    {
        $this->validate();

        return redirect()->route('dashboard');

    }

}
