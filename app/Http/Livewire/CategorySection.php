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

    public function mount()
    {
        $this->parentCategories = Category::query()->orderByDesc('id')->get();
    }

    public function resetForm()
    {
        $this->parent_id = '';
        $this->name = '';
        $this->description = '';
    }

    public function addCategory()
    {
        $this->resetForm();
        $this->emit('open-create-modal');
    }

    public function store()
    {
        $this->validate([
            'name' => 'required',
            'parent_id' => 'required|exists:categories,id'
        ]);

        Category::create([
            'name' => $this->name,
            'description' => $this->description,
            'parent_id' => $this->parent_id
        ]);

        $this->dispatchBrowserEvent('created', ['message' => 'category created successfully!']);

        $this->resetForm();
        $this->mount();
    }


    public function edit(int $id)
    {
        $this->resetForm();

        $category = Category::findOrFail($id);
        $this->category_id = $category->id;
        $this->name = $category->name;
        $this->description = $category->description;
        $this->parent_id = $category->parent_id;

        $this->emit('open-edit-modal');
    }


    public function update()
    {
        $this->validate([
            'name' => 'required',
            'parent_id' => 'required|exists:categories,id'
        ]);

        $category = Category::find($this->category_id);
       
        $category->update([
            'name' => $this->name,
            'description' => $this->description,
            'parent_id' => $this->parent_id
        ]);

    
        $this->dispatchBrowserEvent('updated', ['message' => 'category updated successfully']);
        $this->resetForm();
        
    }


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
