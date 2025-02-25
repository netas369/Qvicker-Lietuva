<?php

namespace App\Livewire;

use App\Models\User;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class MyProfile extends Component
{
    use WithFileUploads;

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
    public $aboutMe;
    public $image;
    public $activeTab = 'profile';


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
        $this->aboutMe = $this->user->aboutme;

        // Retrieve the associated categories for the user
        $this->userCategories = $this->user->categories;

        // You can optionally dump the data for debugging
        // dd($this->user, $this->userCategories);
    }

    public function setTab($tab)
    {
        $this->activeTab = $tab;
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
            'aboutMe' => 'nullable|string|max:500',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048' // Specify allowed image types
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
            'image.image' => 'Failas privalo būti nuotrauka.',
            'image.mimes' => 'Nuotraukos failas privalo būti: jpeg, png, jpg, gif.',
            'image.max' => 'Nuotrauka negali viršyti 2mb dydžio.',
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
        $this->user->aboutme = $this->aboutMe;

        // Check if the password is being updated for later when will be option to update it
        if ($this->slaptazodis) {
            $this->user->password = bcrypt($this->slaptazodis); // Hash the password
        }

        if ($this->image) {
            // Delete old image if exists
            if ($this->user->image) {
                Storage::disk('public')->delete($this->user->image);
            }

            $filename = $this->image->store('profile-photos', 'public');
            $this->user->image = $filename;
        }

        $this->user->save();


        // Optionally, you can redirect or show a success message
        session()->flash('message', 'Informacija sėkmingai atnaujinta');
        return redirect()->route('myprofile'); // Adjust the route as necessary

    }
}
