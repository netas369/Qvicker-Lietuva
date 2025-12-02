<?php

namespace App\Livewire;

use App\Models\User;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
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

    // Password change properties - separate from main form
    public $showPasswordForm = false;
    public $current_password;
    public $new_password;
    public $new_password_confirmation;

    // Auto-save state
    public $aboutMeSaved = false;

    protected $listeners = ['refreshComponent' => '$refresh'];

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
        $this->phone = $this->user->phone ? substr($this->user->phone, 4) : '';

        // Retrieve the associated categories for the user
        $this->userCategories = $this->user->categories;
        $this->gender = $this->user->gender;

        // Handle languages
        if ($this->user->languages) {
            $this->languages = is_array($this->user->languages)
                ? $this->user->languages
                : (json_decode($this->user->languages, true) ?? []);
        } else {
            $this->languages = [];
        }

        // Handle portfolio photos
        if ($this->user->portfolio_photos) {
            $this->portfolioPhotos = is_array($this->user->portfolio_photos)
                ? $this->user->portfolio_photos
                : (json_decode($this->user->portfolio_photos, true) ?? []);
        } else {
            $this->portfolioPhotos = [];
        }

        // Handle cities
        if ($this->user->cities) {
            $this->cities = is_array($this->user->cities)
                ? $this->user->cities
                : (json_decode($this->user->cities, true) ?? []);
        } else {
            $this->cities = [];
        }

        // Set current seeker city if applicable
        if ($this->user->role == 'seeker' && !empty($this->cities) && count($this->cities) > 0) {
            $this->currentSeekerCity = $this->cities[0];
        }
    }

    // Auto-save "About Me" with debounce
    public function updatedAboutMe()
    {
        $this->validate([
            'aboutMe' => 'nullable|string|max:2000'
        ]);

        $this->user->aboutme = $this->aboutMe;
        $this->user->save();

        $this->aboutMeSaved = true;

        // Reset the saved indicator after 2 seconds
        $this->dispatch('aboutMeSaved');
    }

    public function getValidationRules()
    {
        $minBirthDate = Carbon::now()->subYears(14)->format('Y-m-d');

        $rules = [
            'name' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'birthday' => ['required', 'date', 'before_or_equal:' . $minBirthDate],
            'address' => 'required|string|max:255',
            'post_code' => 'required|string|max:5',
            'gender' => 'required',
        ];

        // Only add phone validation for providers
        if ($this->user->role === 'provider') {
            $rules['phone'] = 'required|string|regex:/^6[0-9]{7}$/';
        }

        return $rules;
    }

    public function getPasswordValidationRules()
    {
        return [
            'current_password' => ['required', 'current_password'],
            'new_password' => [
                'required',
                'min:8',
                'confirmed',
                'regex:/^(?=.*[A-Z])(?=.*[0-9])(?=.*[@$!%*#?&]).*$/'
            ],
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
            'regex' => 'Laukas :attribute neatitinka reikalaujamo formato.',

            // Custom rules
            'birthday.before_or_equal' => 'Jūs turite būti bent 14 metų.',
            'phone.regex' => 'Telefono numeris turi prasidėti skaitmeniu 6 ir būti 8 skaitmenų ilgio.',

            // Password-specific rules
            'current_password.required' => 'Dabartinis slaptažodis yra privalomas.',
            'current_password.current_password' => 'Dabartinis slaptažodis neteisingas.',
            'new_password.required' => 'Naujas slaptažodis yra privalomas.',
            'new_password.min' => 'Naujas slaptažodis turi būti bent :min simbolių ilgio.',
            'new_password.confirmed' => 'Naujo slaptažodžio patvirtinimas nesutampa.',
            'new_password.regex' => 'Naujas slaptažodis turi turėti bent vieną didžiąją raidę, vieną skaičių ir vieną specialųjį simbolą (@$!%*#?&).',

            'image.image' => 'Failas privalo būti nuotrauka.',
            'image.mimes' => 'Nuotraukos failas privalo būti: jpeg, png, jpg, gif., webp.',
            'image.max' => 'Nuotrauka negali viršyti 8mb dydžio.',
            'phone.required' => 'Telefono numeris yra privalomas.',
            'post_code.required' => 'Pašto kodas yra privalomas',
            'newPortfolioPhoto.image' => 'Failas privalo būti nuotrauka.',
            'newPortfolioPhoto.mimes' => 'Nuotraukos failas privalo būti: jpeg, png, jpg, gif., webp.',
            'newPortfolioPhoto.max' => 'Nuotrauka negali viršyti 8mb dydžio.',
            'cities.required' => 'Pasirinkite bent vieną miestą.',
            'aboutMe.max' => 'Aprašymas negali viršyti 2000 simbolių.'
        ];
    }

    public function updateProfile()
    {
        $this->validate($this->getValidationRules());

        $this->user->name = $this->name;
        $this->user->lastname = $this->lastname;
        $this->user->birthday = $this->birthday;
        $this->user->email = $this->email;
        $this->user->address = $this->address;
        $this->user->postal_code = $this->post_code;

        if ($this->user->role === 'provider') {
            $this->user->phone = '+370' . $this->phone;
        }

        $this->user->save();

        session()->flash('message', 'Informacija sėkmingai atnaujinta');
        return redirect()->route('myprofile');
    }

    public function togglePasswordForm()
    {
        $this->showPasswordForm = !$this->showPasswordForm;

        // Clear password fields when hiding the form
        if (!$this->showPasswordForm) {
            $this->reset(['current_password', 'new_password', 'new_password_confirmation']);
            $this->resetErrorBag();
        }
    }

    public function updatePassword()
    {
        $this->validate($this->getPasswordValidationRules(), $this->messages());

        $this->user->password = Hash::make($this->new_password);
        $this->user->save();

        // Clear password fields and hide form
        $this->reset(['current_password', 'new_password', 'new_password_confirmation']);
        $this->showPasswordForm = false;

        session()->flash('message', 'Slaptažodis sėkmingai pakeistas');
    }

    public function addCity()
    {
        if (!empty($this->selectedCity) && !in_array($this->selectedCity, $this->cities)) {
            $this->cities[] = $this->selectedCity;
            $this->user->update(['cities' => $this->cities]);
            $this->selectedCity = '';
        }
    }

    public function addSingleCitySeeker()
    {
        if (!empty($this->currentSeekerCity)) {
            $this->cities = [$this->currentSeekerCity];
            $this->user->update(['cities' => $this->cities]);
        }
    }

    public function removeCity($city)
    {
        $this->cities = array_values(array_filter($this->cities, function($c) use ($city) {
            return $c !== $city;
        }));
        $this->user->update(['cities' => $this->cities]);
    }

    public function updatedNewPortfolioPhoto()
    {
        $this->resetErrorBag('newPortfolioPhoto');

        $this->validate(
            ['newPortfolioPhoto' => 'image|mimes:jpeg,png,jpg,gif,webp|max:8192'],
            $this->messages()
        );

        if (count($this->portfolioPhotos) >= $this->maxPortfolioPhotos) {
            session()->flash('error', 'Jūs jau turite maksimalų nuotraukų skaičių (' . $this->maxPortfolioPhotos . ')');
            $this->newPortfolioPhoto = null;
            return;
        }

        $filename = 'portfolio-photos/' . uniqid() . '.jpg';
        $fullPath = storage_path('app/public/' . $filename);

        $directory = dirname($fullPath);
        if (!file_exists($directory)) {
            mkdir($directory, 0755, true);
        }

        $manager = new ImageManager(new Driver());
        $image = $manager->read($this->newPortfolioPhoto->getRealPath());

        if ($image->width() > 1200 || $image->height() > 1200) {
            $image->scale(width: 1200, height: 1200);
        }

        $image->toJpeg(85)->save($fullPath);

        $compressedSize = filesize($fullPath);
        $photoUrl = Storage::url($filename);

        $this->portfolioPhotos[] = [
            'path' => $filename,
            'url' => $photoUrl,
            'size' => $compressedSize,
        ];

        $this->user->portfolio_photos = json_encode($this->portfolioPhotos);
        $this->user->save();

        $this->newPortfolioPhoto = null;

        session()->flash('message', 'Nuotrauka sėkmingai pridėta');
    }

    public function removePortfolioPhoto($index)
    {
        if (isset($this->portfolioPhotos[$index])) {
            Storage::disk('public')->delete($this->portfolioPhotos[$index]['path']);

            unset($this->portfolioPhotos[$index]);
            $this->portfolioPhotos = array_values($this->portfolioPhotos);

            $this->user->portfolio_photos = json_encode($this->portfolioPhotos);
            $this->user->save();

            session()->flash('message', 'Nuotrauka sėkmingai pašalinta');
        }
    }

    public function updatedImage()
    {
        $this->validate([
            'image' => 'image|mimes:jpeg,png,jpg,gif,webp|max:8192',
        ]);

        if ($this->user->image) {
            Storage::disk('public')->delete($this->user->image);
        }

        $filename = 'profile-photos/' . uniqid() . '.jpg';
        $fullPath = storage_path('app/public/' . $filename);

        $directory = dirname($fullPath);
        if (!file_exists($directory)) {
            mkdir($directory, 0755, true);
        }

        $manager = new ImageManager(new Driver());
        $image = $manager->read($this->image->getRealPath());

        if ($image->width() > 800 || $image->height() > 800) {
            $image->scale(width: 800, height: 800);
        }

        $image->toJpeg(90)->save($fullPath);

        $this->user->image = $filename;
        $this->user->save();

        session()->flash('message', 'Nuotrauka sėkmingai atnaujinta!');
        return redirect(request()->header('Referer'));
    }

    public function addLanguage()
    {
        if (!empty($this->selectedLanguage) && !in_array($this->selectedLanguage, $this->languages)) {
            $this->languages[] = $this->selectedLanguage;
            $this->user->update(['languages' => json_encode($this->languages)]);
            $this->selectedLanguage = '';
            session()->flash('message', 'Kalba sėkmingai pridėta');
        }
    }

    public function removeLanguage($language)
    {
        $this->languages = array_values(array_filter($this->languages, function($lang) use ($language) {
            return $lang !== $language;
        }));
        $this->user->update(['languages' => json_encode($this->languages)]);
        session()->flash('message', 'Kalba sėkmingai pašalinta');
    }
}
