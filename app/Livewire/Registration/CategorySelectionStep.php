<?php

namespace App\Livewire\Registration;

use App\Models\Category;
use Livewire\Component;
use Livewire\Attributes\On;
use App\Services\CategoryIconService;

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
                    'icon' => CategoryIconService::getIcon($categoryName),
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

    /**
     * Normalize selectedSubcategories to integers after any update
     * This fixes the type mismatch issue between checkbox string values and database integer IDs
     */
    public function updatedSelectedSubcategories()
    {
        // Convert all values to integers to ensure consistent comparison
        $this->selectedSubcategories = array_map('intval', array_values($this->selectedSubcategories));
    }

    public function setActiveTab($index)
    {
        $this->activeTab = $index;
    }

    public function removeSubcategory($subcategoryId)
    {
        $subcategoryId = (int) $subcategoryId;

        $this->selectedSubcategories = array_values(array_filter(
            $this->selectedSubcategories,
            fn($id) => (int) $id !== $subcategoryId
        ));

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

    /**
     * Helper method to check if a subcategory is selected
     * Uses strict integer comparison
     */
    public function isSelected($subcategoryId): bool
    {
        return in_array((int) $subcategoryId, array_map('intval', $this->selectedSubcategories), true);
    }

    protected function rules()
    {
        $rules = [
            'selectedSubcategories' => 'required|array|min:1',
        ];

        // Add validation for each selected subcategory
        foreach ($this->selectedSubcategories as $subcategoryId) {
            $subcategoryId = (int) $subcategoryId;
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

        // Ensure selectedSubcategories are integers after restoration
        if (!empty($this->selectedSubcategories)) {
            $this->selectedSubcategories = array_map('intval', array_values($this->selectedSubcategories));
        }
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
            'selectedSubcategories' => array_map('intval', $this->selectedSubcategories),
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
