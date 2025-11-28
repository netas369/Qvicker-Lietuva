<?php

namespace App\Livewire\Registration;

use App\Models\Category;
use Livewire\Component;
use Livewire\Attributes\On;

class CategorySelectionStep extends Component
{
    public $selectedSubcategories = [];
    public $subcategoryPrices = [];
    public $subcategoryPriceTypes = [];
    public $subcategoryExperience = [];
    public $activeTab = 0;
    public $categories;

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
                    'subcategories' => $group->map(fn($item) => [
                        'id' => $item->id,
                        'name' => $item->subcategory,
                    ])->toArray(),
                ];
            })->values();
    }

    protected function rules()
    {
        $rules = [
            'selectedSubcategories' => 'required|array|min:1',
            'subcategoryExperience.*' => 'nullable|integer|min:0|max:50',
        ];

        foreach ($this->selectedSubcategories as $subcategoryId) {
            $rules["subcategoryPrices.{$subcategoryId}"] = 'required|numeric|min:0|max:1000';
            $rules["subcategoryPriceTypes.{$subcategoryId}"] = 'required|in:hourly,fixed,meter';
        }

        return $rules;
    }

    public function messages()
    {
        return [
            'selectedSubcategories.required' => 'Privaloma pasirinkti bent vieną kategoriją',
            'selectedSubcategories.min' => 'Privaloma pasirinkti bent vieną kategoriją',
            'subcategoryPrices.*.numeric' => 'Kaina turi būti skaičius.',
            'subcategoryPrices.*.required' => 'Kaina yra privaloma.',
            'subcategoryPriceTypes.*.required' => 'Kainos tipas yra privalomas.',
        ];
    }

    public function setActiveTab($index)
    {
        $this->activeTab = $index;
    }

    public function removeSubcategory($id)
    {
        $this->selectedSubcategories = array_values(
            array_filter($this->selectedSubcategories, fn($subcategoryId) => $subcategoryId != $id)
        );

        unset($this->subcategoryPrices[$id]);
        unset($this->subcategoryPriceTypes[$id]);
        unset($this->subcategoryExperience[$id]);
    }

    #[On('trigger-category-submit')]
    public function triggerSubmit()
    {
        $this->submit();
    }

    #[On('restore-category-data')]
    public function restoreData($categoryData)
    {
        $this->selectedSubcategories = $categoryData['selectedSubcategories'] ?? [];
        $this->subcategoryPrices = $categoryData['subcategoryPrices'] ?? [];
        $this->subcategoryPriceTypes = $categoryData['subcategoryPriceTypes'] ?? [];
        $this->subcategoryExperience = $categoryData['subcategoryExperience'] ?? [];
    }

    public function submit()
    {
        $this->validate();

        $this->dispatch('categories-validated', categoryData: [
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
