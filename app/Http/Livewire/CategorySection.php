<?php

namespace App\Http\Livewire;

use App\Models\Category;
use Livewire\Component;

class CategorySection extends Component
{
    public $name;
    public $description;
    public $parent_id;
    public $category_id;



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
            'parent_id' => 'nullable|exists:categories,id'
        ]);

        Category::create([
            'name' => $this->name,
            'description' => $this->description,
            'parent_id' => $this->parent_id
        ]);

        $this->dispatchBrowserEvent('created');

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
            'parent_id' => 'nullable|exists:categories,id'
        ]);

        Category::where('id', $this->category_id)->update([
            'name' => $this->name,
            'description' => $this->description,
            'parent_id' => $this->parent_id
        ]);

        $this->dispatchBrowserEvent('updated');
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
        $this->dispatchBrowserEvent('deleted', ['message' => 'долг удалено успешно!']);
    }


    public function render()
    {
        $categories = Category::withCount(['children', 'products'])->get();
        return view('livewire.category-section', [
            'categories' => $categories
        ]);
    }
}
