<?php

namespace App\Http\Livewire;

use App\Models\Category;
use Livewire\Component;

class CategorySection extends Component
{

    protected $listeners = ['deleteConfirmed' => 'delete'];
    public $name;
    public $description;
    public $parent_id;
    public $category_id;

    public $parentCategories;

    


    public function deleteConfirm(int $id)
    {
        $this->category_id = $id;
        $this->dispatchBrowserEvent('delete-confirm');
    }


    public function delete()
    {
        $category = Category::find($this->category_id);
        $category->delete();
        $this->dispatchBrowserEvent('deleted', ['message' => 'category deleted successfully!']);
    }


    public function render()
    {
        $categories = Category::withCount(['children', 'products'])->get();
    
        return view('livewire.category-section', [
            'categories' => $categories,
            
        ])->extends('layouts.app');
    }
}
