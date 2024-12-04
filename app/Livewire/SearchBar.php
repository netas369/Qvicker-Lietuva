<?php

namespace App\Livewire;

use App\Models\Category;
use Livewire\Component;

class SearchBar extends Component
{
    public $search = "";

    public function render()
    {
        $results = [];

        if(strlen($this->search) >= 1) {
            $results = Category::where('subcategory', 'like', '%'. $this->search. '%')->limit(7)->get();
        }

        return view('livewire.search-bar', [
            'results' => $results
        ]);
    }
}
