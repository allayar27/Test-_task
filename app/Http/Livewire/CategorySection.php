<?php

namespace App\Http\Livewire;

use App\Models\Category;
use Livewire\Component;

class CategorySection extends Component
{
    public $name;
    public $description;


    protected $rules = [
        'category_name' => 'required|min:3',
    ];


    public function store()
    {
        $validateData = $this->validate();
        Category::create($validateData);
    }

    public function render()
    {
        $categories = Category::query()
                                ->withCount('subcategories')
                                ->withCount('products')
                                ->whereNull('parent_id')->get();
        return view('livewire.category-section', [
            'categories' => $categories
        ]);
    }
}
