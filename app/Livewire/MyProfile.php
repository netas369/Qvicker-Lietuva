<?php

namespace App\Livewire;

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
    public $subcategories = [];
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
        $this->subcategories = json_decode($this->user->subcategories, true) ?? [];
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
