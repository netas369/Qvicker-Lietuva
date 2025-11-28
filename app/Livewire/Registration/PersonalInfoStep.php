<?php

namespace App\Livewire\Registration;

use Livewire\Component;
use Livewire\Attributes\On;
use Carbon\Carbon;

class PersonalInfoStep extends Component
{
    public $vardas = '';
    public $pavarde = '';
    public $gimimo_data = '';
    public $email = '';
    public $miestas = '';
    public $adresas = '';
    public $post_code = '';
    public $phone = '';
    public $slaptazodis = '';
    public $slaptazodis_confirmation = '';
    public $gender = '';
    public $languages = [];
    public $selectedLanguage = '';

    // Password visibility toggles
    public $showPassword = false;
    public $showPasswordConfirmation = false;

    protected function rules()
    {
        $minDate = Carbon::now()->subYears(100)->format('Y-m-d');
        $maxDate = Carbon::now()->subYears(14)->format('Y-m-d');

        return [
            'vardas' => 'required|string|max:255',
            'pavarde' => 'required|string|max:255',
            'gimimo_data' => "required|date|before_or_equal:{$maxDate}|after_or_equal:{$minDate}",
            'gender' => 'required|in:male,female,other',
            'email' => 'required|email|unique:users,email',
            'phone' => 'required|numeric|digits:8',
            'miestas' => 'required|string',
            'adresas' => 'required|string|max:255',
            'post_code' => 'required|string|size:5',
            'languages' => 'required|array|min:1',
            'slaptazodis' => [
                'required',
                'string',
                'min:10',
                'confirmed',
                'regex:/[A-Z]/',      // At least one uppercase letter
                'regex:/[0-9]/',      // At least one number
                'regex:/[@$!%*#?&]/', // At least one symbol
            ],
        ];
    }

    protected function messages()
    {
        return [
            'vardas.required' => 'Vardas yra privalomas.',
            'vardas.max' => 'Vardas negali būti ilgesnis nei 255 simboliai.',
            'pavarde.required' => 'Pavardė yra privaloma.',
            'pavarde.max' => 'Pavardė negali būti ilgesnė nei 255 simboliai.',
            'gimimo_data.required' => 'Gimimo data yra privaloma.',
            'gimimo_data.date' => 'Gimimo data turi būti galiojanti data.',
            'gimimo_data.before_or_equal' => 'Jums turi būti bent 14 metų.',
            'gimimo_data.after_or_equal' => 'Netinkama gimimo data.',
            'gender.required' => 'Lytis yra privaloma.',
            'gender.in' => 'Pasirinkite tinkamą lytį.',
            'email.required' => 'El. paštas yra privalomas.',
            'email.email' => 'El. paštas turi būti galiojantis.',
            'email.unique' => 'Šis el. paštas jau užimtas.',
            'phone.required' => 'Telefono numeris yra privalomas.',
            'phone.numeric' => 'Telefono numeris turi būti skaičius.',
            'phone.digits' => 'Telefono numeris turi būti 8 skaitmenų.',
            'miestas.required' => 'Miestas yra privalomas.',
            'adresas.required' => 'Adresas yra privalomas.',
            'adresas.max' => 'Adresas negali būti ilgesnis nei 255 simboliai.',
            'post_code.required' => 'Pašto kodas yra privalomas.',
            'post_code.size' => 'Pašto kodas turi būti 5 skaitmenų.',
            'languages.required' => 'Pasirinkite bent vieną kalbą.',
            'languages.min' => 'Pasirinkite bent vieną kalbą.',
            'slaptazodis.required' => 'Slaptažodis yra privalomas.',
            'slaptazodis.min' => 'Slaptažodis turi būti bent 10 simbolių.',
            'slaptazodis.confirmed' => 'Slaptažodžiai nesutampa.',
            'slaptazodis.regex' => 'Slaptažodis turi turėti bent vieną didžiąją raidę, skaičių ir simbolį (@$!%*#?&).',
        ];
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function togglePasswordVisibility()
    {
        $this->showPassword = !$this->showPassword;
    }

    public function togglePasswordConfirmationVisibility()
    {
        $this->showPasswordConfirmation = !$this->showPasswordConfirmation;
    }

    public function addLanguage()
    {
        if ($this->selectedLanguage && !in_array($this->selectedLanguage, $this->languages)) {
            $this->languages[] = $this->selectedLanguage;
            $this->selectedLanguage = '';
        }
    }

    public function removeLanguage($index)
    {
        unset($this->languages[$index]);
        $this->languages = array_values($this->languages); // Re-index array
    }

    #[On('trigger-personal-info-submit')]
    public function triggerSubmit()
    {
        $this->submit();
    }

    #[On('trigger-personal-info-validation-for-register')]
    public function validateForRegister()
    {
        // Validate all fields
        $validatedData = $this->validate();

        // Send validated data back to wizard
        $this->dispatch('personal-info-validated', personalData: $validatedData);
    }

    #[On('restore-personal-data')]
    public function restoreData($personalData)
    {
        $this->fill($personalData);
    }

    public function submit()
    {
        $validatedData = $this->validate();

        $this->dispatch('personal-info-validated', personalData: $validatedData);
    }

    public function render()
    {
        return view('livewire.registration.personal-info-step');
    }
}
