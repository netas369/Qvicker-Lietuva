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
    public $post_code;
    public $phone;
    public $userCategories = [];
    public $slaptazodis;
    public $slaptazodis_confirmation;
    public $aboutMe;
    public $image;
    public $gender;
    public $languages = [];
    public $selectedLanguage = '';
    public $portfolioPhotos = [];
    public $newPortfolioPhoto;
    public $maxPortfolioPhotos = 5;
    public $cities = [];
    public $selectedCity = '';
    public $currentSeekerCity;


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
        $this->address = $this->user->address;
        $this->aboutMe = $this->user->aboutme;
        $this->post_code = $this->user->postal_code;
        $this->phone = substr($this->user->phone, 4);
        // Retrieve the associated categories for the user
        $this->userCategories = $this->user->categories;
        $this->gender = $this->user->gender;

        if ($this->user->languages) {
            $this->languages = json_decode($this->user->languages, true) ?? [];
        }

        if ($this->user->portfolio_photos) {
            $this->portfolioPhotos = json_decode($this->user->portfolio_photos, true) ?? [];
        }

        // Get the cities from user
        $rawCities = auth()->user()->cities;

        // Check if it's already an array or a JSON string
        if (is_string($rawCities)) {
            // It's still a JSON string, so decode it
            $this->cities = json_decode($rawCities, true) ?? [];
        } else {
            // It's already an array
            $this->cities = $rawCities;
        }

        // If it's still not an array or is null, initialize as empty array
        if (!is_array($this->cities)) {
            $this->cities = [];
        }

        // Add this to your existing mount method or create if it doesn't exist
        if ($this->user->role == 'seeker' && !empty($this->cities) && count($this->cities) > 0) {
            $this->currentSeekerCity = $this->cities[0];
        }

    }


    public function getValidationRules()
    {
        $minBirthDate = Carbon::now()->subYears(14)->format('Y-m-d');

        return [
            'name' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'birthday' => ['required', 'date', 'before_or_equal:' . $minBirthDate],
            'address' => 'required|string|max:255',
            'post_code' => 'required|string|max:5',
            'phone' => 'required|string|regex:/^6[0-9]{7}$/',
            'aboutMe' => 'nullable|string|max:500',
            'gender' => 'required',
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
            'regex' => 'Laukas :attribute neatitinka reikalaujamo formato.',
            'size' => 'Laukas :attribute turi būti :size simbolių ilgio.',
            // Custom rules
            'gimimo_data.before_or_equal' => 'Jūs turite būti bent 14 metų.',
            'phone.regex' => 'Telefono numeris turi prasidėti skaitmeniu 6 ir būti 8 skaitmenų ilgio.',
            'phone.size' => 'Telefono numeris turi būti 8 skaitmenų ilgio.',
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
            'image.max' => 'Nuotrauka negali viršyti 4mb dydžio.',
            'phone.required' => 'Telefono numeris yra privalomas.',
            'post_code.required' => 'Pašto kodas yra privalomas',
            'newPortfolioPhoto.image' => 'Failas privalo būti nuotrauka.',
            'newPortfolioPhoto.mimes' => 'Nuotraukos failas privalo būti: jpeg, png, jpg, gif.',
            'newPortfolioPhoto.max' => 'Nuotrauka negali viršyti 4mb dydžio.',
            'cities.required' => 'Pasirinkite bent vieną miestą.'

        ];
    }

    public function update()
    {
        $this->validate($this->getValidationRules());

        $this->user->name = $this->name;
        $this->user->lastname = $this->lastname;
        $this->user->birthday = $this->birthday;
        $this->user->email = $this->email;
        $this->user->address = $this->address;
        $this->user->aboutme = $this->aboutMe;
        $this->user->postal_code = $this->post_code;
        $this->user->phone = '+370' . $this->phone;

        $this->user->save();


        // Optionally, you can redirect or show a success message
        session()->flash('message', 'Informacija sėkmingai atnaujinta');
        return redirect()->route('myprofile'); // Adjust the route as necessary

    }

    public function addCity()
    {
        if (!empty($this->selectedCity) && !in_array($this->selectedCity, $this->cities)) {
            // Add to local array
            $this->cities[] = $this->selectedCity;

            // Immediately update in database
            $this->user->update([
                'cities' => $this->cities
            ]);

            // Reset selection
            $this->selectedCity = '';

        }
    }

    public function addSingleCitySeeker()
    {
        if (!empty($this->currentSeekerCity)) {
            // Override any existing city (only one allowed for seekers)
            $this->cities = [$this->currentSeekerCity];

            // Immediately update in database
            $this->user->update([
                'cities' => $this->cities
            ]);
        }
    }

    public function removeCity($city)
    {
        // Remove from local array
        $this->cities = array_values(array_filter($this->cities, function($c) use ($city) {
            return $c !== $city;
        }));

        // Immediately update in database
        $this->user->update([
            'cities' => $this->cities
        ]);

    }

    // New method to handle portfolio photo uploads
    public function updatedNewPortfolioPhoto()
    {
        $this->validate([
            'newPortfolioPhoto' => 'image|mimes:jpeg,png,jpg,gif|max:4092',
        ]);

        // Check if we already have maximum photos
        if (count($this->portfolioPhotos) >= $this->maxPortfolioPhotos) {
            session()->flash('error', 'Jūs jau turite maksimalų nuotraukų skaičių (' . $this->maxPortfolioPhotos . ')');
            $this->newPortfolioPhoto = null;
            return;
        }

        // Store the new photo
        $filename = $this->newPortfolioPhoto->store('portfolio-photos', 'public');
        $photoUrl = Storage::url($filename);

        // Add to the photos array
        $this->portfolioPhotos[] = [
            'path' => $filename,
            'url' => $photoUrl,
        ];

        // Save to the user model
        $this->user->portfolio_photos = json_encode($this->portfolioPhotos);
        $this->user->save();

        // Reset the upload field
        $this->newPortfolioPhoto = null;

        session()->flash('message', 'Nuotrauka sėkmingai pridėta');
    }

    // Method to remove a portfolio photo
    public function removePortfolioPhoto($index)
    {
        if (isset($this->portfolioPhotos[$index])) {
            // Delete the file from storage
            Storage::disk('public')->delete($this->portfolioPhotos[$index]['path']);

            // Remove from array
            unset($this->portfolioPhotos[$index]);
            $this->portfolioPhotos = array_values($this->portfolioPhotos); // Re-index

            // Update user record
            $this->user->portfolio_photos = json_encode($this->portfolioPhotos);
            $this->user->save();

            session()->flash('message', 'Nuotrauka sėkmingai pašalinta');
        }
    }

    public function updatedImage()
    {
        $this->validate([
            'image' => 'image|max:4092', // 1MB Max
        ]);

        if ($this->user->image) {
            Storage::disk('public')->delete($this->user->image);
        }

        // Process and save the image immediately
        $filename = $this->image->store('profile-photos', 'public');

        // Update user's profile image in the database
        $this->user->image = $filename;
        $this->user->save();

        // Show success message
        session()->flash('message', 'Nuotrauka sėkmingai atnaujinta!');

        return redirect(request()->header('Referer'));
    }

    public function addLanguage()
    {
        if (!empty($this->selectedLanguage) && !in_array($this->selectedLanguage, $this->languages)) {
            $this->languages[] = $this->selectedLanguage;
            $this->selectedLanguage = ''; // Reset selection
        }
    }

    public function removeLanguage($language)
    {
        $this->languages = array_values(array_filter($this->languages, function($lang) use ($language) {
            return $lang !== $language;
        }));
    }
}
