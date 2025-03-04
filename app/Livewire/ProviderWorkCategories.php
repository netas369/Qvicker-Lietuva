<?php

namespace App\Livewire;

use App\Models\Category;
use Livewire\Component;

class ProviderWorkCategories extends Component
{
    public $selectedCategories = [];
    public $groupedCategories = [];

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
    }

    public function loadCategories()
    {
        // Get all categories grouped by main category
        $categories = Category::all();

        // Group them by main category
        $this->groupedCategories = $categories->groupBy('category')->toArray();
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

        // Show appropriate success message based on action
        if ($actionType === 'added') {
            session()->flash('message', "Kategorija {$categoryName} sėkmingai pridėta!");
            session()->flash('messageType', 'added');
        } elseif ($actionType === 'removed') {
            session()->flash('message', "Kategorija {$categoryName} sėkmingai pašalinta!");
            session()->flash('messageType', 'removed');
        } else {
            session()->flash('message', "Kategorijos sėkmingai atnaujintos!");
            // Use default message type for general updates
        }
    }

    public function render()
    {
        return view('livewire.provider-work-categories');
    }
}
