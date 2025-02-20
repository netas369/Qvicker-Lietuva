<?php

namespace App\Livewire;

use App\Models\User;
use Illuminate\Support\Carbon;
use Livewire\Component;

class MyProfile extends Component
{
    public $user;
    public $name;
    public $lastname;
    public $email;
    public $birthday;
    public $city;
    public $address;
    public $userCategories = [];
    public $slaptazodis;
    public $slaptazodis_confirmation;

    public function render()
    {
        return view('livewire.my-profile');
    }

    public function mount()
    {
        $this->user = auth()->user();
        $this->name = $this->user->name;
        $this->lastname = $this->user->lastname;
        $this->email = $this->user->email;
        $this->birthday = $this->user->birthday;
        $this->city = $this->user->city;
        $this->address = $this->user->address;

        // Retrieve the associated categories for the user
        $this->userCategories = $this->user->categories;

        // You can optionally dump the data for debugging
        // dd($this->user, $this->userCategories);
    }

    public function getValidationRules()
    {
        $minBirthDate = Carbon::now()->subYears(14)->format('Y-m-d');

        return [
            'name' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'birthday' => ['required', 'date', 'before_or_equal:' . $minBirthDate],
            'city' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            ];
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
            'name' => 'vardas',
            'lastname' => 'pavardė',
            'birthday' => 'gimimo data',
            'email' => 'el. paštas',
            'city' => 'miestas',
            'address' => 'adresas',
            'password' => 'slaptažodis',
            'slaptazodis_confirmation' => 'slaptažodžio patvirtinimas'
        ];
    }

    public function update()
    {
        $this->validate($this->getValidationRules());

        $this->user->name = $this->name;
        $this->user->lastname = $this->lastname;
        $this->user->birthday = $this->birthday;
        $this->user->email = $this->email;
        $this->user->city = $this->city;
        $this->user->address = $this->address;

        // Check if the password is being updated for later when will be option to update it
        if ($this->slaptazodis) {
            $this->user->password = bcrypt($this->slaptazodis); // Hash the password
        }

        $this->user->save();


        // Optionally, you can redirect or show a success message
        session()->flash('message', 'Informacija sėkmingai atnaujinta');
        return redirect()->route('myprofile'); // Adjust the route as necessary

    }
}
