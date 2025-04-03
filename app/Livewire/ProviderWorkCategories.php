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
    protected $listeners = ['refreshCategories' => 'loadCategories'];

    protected $rules = [
        'selectedCategories' => 'array',
        'selectedCategories.*' => 'exists:categories,id',
    ];

    public function mount()
    {
        // Load the user's currently selected categories
        $this->selectedCategories = auth()->user()->categories->pluck('id')->toArray();

        // Load and group all available categories
        $this->loadCategories();

        $this->getUserCategories();

    }

    public function loadCategories()
    {
        // Get all categories
        $query = Category::query();

        // Apply search filter if provided
        if (!empty($this->searchQuery)) {
            $query->where(function($q) {
                $q->where('subcategory', 'like', '%' . $this->searchQuery . '%')
                    ->orWhere('category', 'like', '%' . $this->searchQuery . '%');
            });
        }

        $categories = $query->get();

        // Group them by main category
        $this->groupedCategories = $categories->groupBy('category')->toArray();
    }

    public function updatedSearchQuery()
    {
        $this->loadCategories();
    }

    public function toggleCategory($categoryId)
    {
        // Check if already selected
        if (in_array($categoryId, $this->selectedCategories)) {
            // Remove from selected categories
            $this->selectedCategories = array_diff($this->selectedCategories, [$categoryId]);
            $actionType = 'removed';
        } else {
            // Add to selected categories
            $this->selectedCategories[] = $categoryId;
            $actionType = 'added';
        }

        // Immediately update the database
        $this->saveToDatabase($actionType, $categoryId);

        // Refresh the categories lists
        $this->loadCategories();
        $this->getUserCategories(); // Add this line to refresh user categories
    }

    protected function saveToDatabase($actionType, $categoryId = null)
    {
        // Get the current user
        $user = auth()->user();

        // Sync the selected categories
        $user->categories()->sync($this->selectedCategories);

        // Get category name for the message
        $categoryName = '';
        if ($categoryId) {
            $category = Category::find($categoryId);
            if ($category) {
                $categoryName = "'{$category->subcategory}'";
            }
        }

        // Set component notification instead of using session flashes
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
        } else {
            $this->notification = [
                'message' => "Kategorijos sėkmingai atnaujintos!",
                'type' => 'updated'
            ];
        }
    }

    public function clearNotification()
    {
        $this->notification = null;
    }

    public function getUserCategories()
    {
        // First get the collection
        $categories = Category::whereIn('id', $this->selectedCategories)
            ->get();

        // Then manually convert to an array structure that Livewire can handle
        $grouped = [];
        foreach ($categories->groupBy('category') as $mainCategory => $subcategories) {
            $subcategoryArray = [];
            foreach ($subcategories as $subcategory) {
                $subcategoryArray[] = [
                    'id' => $subcategory->id,
                    'subcategory' => $subcategory->subcategory,
                    // Add other needed fields
                ];
            }
            $grouped[$mainCategory] = $subcategoryArray;
        }

        $this->userCategories = $grouped;
    }

    public function render()
    {
        return view('livewire.provider-work-categories');
    }
}
