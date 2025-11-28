<?php

namespace App\Livewire\Registration;

use App\Models\Category;
use Livewire\Component;
use Livewire\Attributes\On;

class CategorySelectionStep extends Component
{
    public $categories = [];
    public $activeTab = 0;
    public $selectedSubcategories = [];
    public $subcategoryPrices = [];
    public $subcategoryPriceTypes = [];
    public $subcategoryExperience = [];
    public $searchTerm = '';
    public $filteredSubcategories = [];

    public function mount()
    {
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
                    'icon' => '',
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

    public function updatedSearchTerm()
    {
        if (empty($this->searchTerm)) {
            $this->filteredSubcategories = [];
            return;
        }

        // Search across all categories and subcategories
        $allSubcategories = Category::select('id', 'category', 'subcategory')
            ->where('subcategory', 'like', '%' . $this->searchTerm . '%')
            ->orWhere('category', 'like', '%' . $this->searchTerm . '%')
            ->get()
            ->map(function ($item) {
                return [
                    'id' => $item->id,
                    'name' => $item->subcategory,
                    'category' => $item->category,
                ];
            })
            ->toArray();

        $this->filteredSubcategories = $allSubcategories;
    }

    public function setActiveTab($index)
    {
        $this->activeTab = $index;
    }

    public function removeSubcategory($subcategoryId)
    {
        $this->selectedSubcategories = array_filter(
            $this->selectedSubcategories,
            fn($id) => $id != $subcategoryId
        );

        // Remove associated data
        unset($this->subcategoryPrices[$subcategoryId]);
        unset($this->subcategoryPriceTypes[$subcategoryId]);
        unset($this->subcategoryExperience[$subcategoryId]);
    }

    public function clearAllSubcategories()
    {
        $this->selectedSubcategories = [];
        $this->subcategoryPrices = [];
        $this->subcategoryPriceTypes = [];
        $this->subcategoryExperience = [];
    }

    protected function rules()
    {
        $rules = [
            'selectedSubcategories' => 'required|array|min:1',
        ];

        // Add validation for each selected subcategory
        foreach ($this->selectedSubcategories as $subcategoryId) {
            $rules["subcategoryPrices.{$subcategoryId}"] = 'required|numeric|min:0|max:1000';
            $rules["subcategoryPriceTypes.{$subcategoryId}"] = 'required|in:hourly,fixed,meter';
            $rules["subcategoryExperience.{$subcategoryId}"] = 'nullable|integer|min:0|max:50';
        }

        return $rules;
    }

    protected function messages()
    {
        return [
            'selectedSubcategories.required' => 'Privalote pasirinkti bent vieną paslaugą.',
            'selectedSubcategories.min' => 'Privalote pasirinkti bent vieną paslaugą.',
            'subcategoryPrices.*.required' => 'Kaina yra privaloma.',
            'subcategoryPrices.*.numeric' => 'Kaina turi būti skaičius.',
            'subcategoryPrices.*.min' => 'Kaina negali būti neigiama.',
            'subcategoryPrices.*.max' => 'Kaina negali viršyti 1000€.',
            'subcategoryPriceTypes.*.required' => 'Kainos tipas yra privalomas.',
            'subcategoryPriceTypes.*.in' => 'Pasirinkite tinkamą kainos tipą.',
            'subcategoryExperience.*.integer' => 'Patirtis turi būti sveikasis skaičius.',
            'subcategoryExperience.*.min' => 'Patirtis negali būti neigiama.',
            'subcategoryExperience.*.max' => 'Patirtis negali viršyti 50 metų.',
        ];
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    #[On('restore-category-data')]
    public function restoreData($categoryData)
    {
        $this->fill($categoryData);
    }

    #[On('trigger-category-submit')]
    public function triggerSubmit()
    {
        $this->submit();
    }

    public function submit()
    {
        $validatedData = $this->validate();

        $this->dispatch('category-data-validated', categoryData: [
            'selectedSubcategories' => $this->selectedSubcategories,
            'subcategoryPrices' => $this->subcategoryPrices,
            'subcategoryPriceTypes' => $this->subcategoryPriceTypes,
            'subcategoryExperience' => $this->subcategoryExperience,
        ]);
    }

    public function render()
    {
        return view('livewire.registration.category-selection-step');
    }
}
