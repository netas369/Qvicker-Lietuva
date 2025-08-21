<?php

namespace App\Livewire;

use App\Models\Category;
use Livewire\Component;

class ProviderWorkCategories extends Component
{
    public $selectedCategories = [];
    public $groupedCategories = [];
    public $searchQuery = '';
    public $notification = null;
    public $userCategories = [];

    public $categoryPrices = [];
    public $categoryTypes = [];
    public $categoryExperience = [];

    // Add these for new category modal
    public $showAddModal = false;
    public $newCategoryId = null;
    public $newCategoryName = '';
    public $newCategoryPrice = '';
    public $newCategoryType = '';
    public $newCategoryExperience = '';

    protected $listeners = ['refreshCategories' => 'loadCategories'];

    protected $rules = [
        'selectedCategories' => 'array',
        'selectedCategories.*' => 'exists:categories,id',
        'categoryPrices.*' => 'required|numeric|min:0|max:1000',
        'categoryTypes.*' => 'required|in:hourly,fixed,meter',
        'categoryExperience.*' => 'nullable|integer|min:0|max:50',
    ];

    public function mount()
    {
        $this->selectedCategories = auth()->user()->categories->pluck('id')->toArray();
        $this->loadCategories();
        $this->getUserCategories();
    }

    public function loadCategories()
    {
        $query = Category::query();

        if (!empty($this->searchQuery)) {
            $query->where(function($q) {
                $q->where('subcategory', 'like', '%' . $this->searchQuery . '%')
                    ->orWhere('category', 'like', '%' . $this->searchQuery . '%');
            });
        }

        $categories = $query->get();
        $this->groupedCategories = $categories->groupBy('category')->map(function($group) {
            return $group->toArray();
        })->toArray();    }

    public function updatedSearchQuery()
    {
        $this->loadCategories();
    }


    public function openAddModal($categoryId)
    {
        $category = Category::find($categoryId);
        $this->newCategoryId = $categoryId;
        $this->newCategoryName = $category->subcategory;
        $this->newCategoryPrice = '';
        $this->newCategoryType = '';
        $this->newCategoryExperience = '';
        $this->showAddModal = true;
    }

    public function addCategoryWithData()
    {
        // Validate required fields
        $this->validate([
            'newCategoryPrice' => 'required|numeric|min:0|max:1000',
            'newCategoryType' => 'required|in:hourly,fixed,meter',
            'newCategoryExperience' => 'nullable|integer|min:0|max:50',
        ]);

        // Add to selected categories
        $this->selectedCategories[] = $this->newCategoryId;

        // Store the data
        $this->categoryPrices[$this->newCategoryId] = $this->newCategoryPrice;
        $this->categoryTypes[$this->newCategoryId] = $this->newCategoryType;
        $this->categoryExperience[$this->newCategoryId] = $this->newCategoryExperience ?: null;

        // Save to database
        $this->saveToDatabase('added', $this->newCategoryId);

        // Close modal and refresh
        $this->showAddModal = false;
        $this->loadCategories();
        $this->getUserCategories();

        // Dispatch browser event to trigger scroll
        $this->dispatch('category-added', categoryId: $this->newCategoryId);
    }

    public function removeCategory($categoryId)
    {
        $this->selectedCategories = array_diff($this->selectedCategories, [$categoryId]);

        unset($this->categoryPrices[$categoryId]);
        unset($this->categoryTypes[$categoryId]);
        unset($this->categoryExperience[$categoryId]);

        $this->saveToDatabase('removed', $categoryId);
        $this->loadCategories();
        $this->getUserCategories();
    }

    public function updateCategoryData($categoryId, $field, $value)
    {
        // Validate the specific field with proper property names
        $rules = [];
        switch($field) {
            case 'price':
                $rules = ["categoryPrices.{$categoryId}" => 'required|numeric|min:0|max:1000']; // Changed from integer to numeric
                $this->categoryPrices[$categoryId] = $value; // Sync local property
                break;
            case 'type':
                $rules = ["categoryTypes.{$categoryId}" => 'required|in:hourly,fixed,meter'];
                $this->categoryTypes[$categoryId] = $value; // Sync local property
                break;
            case 'experience':
                $rules = ["categoryExperience.{$categoryId}" => 'nullable|integer|min:0|max:50'];
                $this->categoryExperience[$categoryId] = $value ?: null; // Sync local property
                break;
        }

        $this->validate($rules);

        // Convert empty experience values to null before saving
        if ($field === 'experience' && $value === '') {
            $value = null;
        }

        // Update the pivot table
        auth()->user()->categories()->updateExistingPivot($categoryId, [$field => $value]);

        // Refresh user categories to ensure consistency
        $this->getUserCategories();

        // Show success notification
        $category = Category::find($categoryId);
        $fieldName = $field === 'type' ? 'kainos tipas' : ($field === 'experience' ? 'patirtis' : 'kaina');

        $this->notification = [
            'message' => "Kategorijos '{$category->subcategory}' {$fieldName} atnaujinta!",
            'type' => 'updated'
        ];
    }

    protected function saveToDatabase($actionType, $categoryId = null)
    {
        $user = auth()->user();

        if ($actionType === 'added') {
            // Add with the provided data, converting empty experience to null
            $user->categories()->attach($categoryId, [
                'price' => $this->categoryPrices[$categoryId],
                'type' => $this->categoryTypes[$categoryId],
                'experience' => $this->categoryExperience[$categoryId] ?: null, // Convert empty string to null
            ]);
        } else {
            // For removal, sync remaining categories
            $pivotData = [];
            foreach ($this->selectedCategories as $catId) {
                $pivotData[$catId] = [
                    'price' => $this->categoryPrices[$catId] ?? null,
                    'type' => $this->categoryTypes[$catId] ?? null,
                    'experience' => ($this->categoryExperience[$catId] ?? '') ?: null, // Convert empty string to null
                ];
            }
            $user->categories()->sync($pivotData);
        }

        // Set notification
        $categoryName = '';
        if ($categoryId) {
            $category = Category::find($categoryId);
            if ($category) {
                $categoryName = "'{$category->subcategory}'";
            }
        }

        if ($actionType === 'added') {
            $this->notification = [
                'message' => "Kategorija {$categoryName} sėkmingai pridėta!",
                'type' => 'added'
            ];
        } elseif ($actionType === 'removed') {
            $this->notification = [
                'message' => "Kategorija {$categoryName} sėkmingai pašalinta!",
                'type' => 'removed'
            ];
        }
    }

    public function clearNotification()
    {
        $this->notification = null;
    }

    public function getUserCategories()
    {
        $userCategoriesWithPivot = auth()->user()->categories()->get();

        $grouped = [];
        foreach ($userCategoriesWithPivot->groupBy('category') as $mainCategory => $subcategories) {
            $subcategoryArray = [];
            foreach ($subcategories as $subcategory) {
                $subcategoryArray[] = [
                    'id' => $subcategory->id,
                    'subcategory' => $subcategory->subcategory,
                    'price' => $subcategory->pivot->price,
                    'type' => $subcategory->pivot->type,
                    'experience' => $subcategory->pivot->experience,
                ];

                $this->categoryPrices[$subcategory->id] = $subcategory->pivot->price;
                $this->categoryTypes[$subcategory->id] = $subcategory->pivot->type;
                $this->categoryExperience[$subcategory->id] = $subcategory->pivot->experience;
            }
            $grouped[$mainCategory] = $subcategoryArray;
        }

        $this->userCategories = $grouped;
    }

    public function messages()
    {
        return [
            'categoryPrices.*.required' => 'Kaina yra privaloma.',
            'categoryPrices.*.numeric' => 'Kaina turi būti skaičius.',
            'categoryPrices.*.min' => 'Kaina negali būti neigiama.',
            'categoryTypes.*.required' => 'Kainos tipas yra privalomas.',
            'categoryTypes.*.in' => 'Pasirinkite teisingą kainos tipą.',
            'categoryExperience.*.integer' => 'Patirtis turi būti skaičius.',
            'categoryExperience.*.min' => 'Patirtis negali būti neigiama.',
            'categoryExperience.*.max' => 'Patirtis negali būti daugiau nei 50 metų.',
            // Add messages for new category modal
            'newCategoryPrice.required' => 'Kaina yra privaloma.',
            'newCategoryPrice.numeric' => 'Kaina turi būti skaičius.',
            'newCategoryPrice.min' => 'Kaina negali būti neigiama.',
            'newCategoryPrice.max' => 'Kaina negali būti daugiau nei 1000 eur.',
            'newCategoryType.required' => 'Kainos tipas yra privalomas.',
            'newCategoryType.in' => 'Pasirinkite teisingą kainos tipą.',
            'newCategoryExperience.integer' => 'Patirtis turi būti skaičius.',
            'newCategoryExperience.min' => 'Patirtis negali būti neigiama.',
            'newCategoryExperience.max' => 'Patirtis negali būti daugiau nei 50 metų.',
        ];
    }

    public function render()
    {
        return view('livewire.provider-work-categories');
    }
}
