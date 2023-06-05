<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class CategoryController extends Controller
{
    public function create(): View
    {
        $parentCategories = Category::query()->select('id', 'name')->get();
        return view('category.create', compact('parentCategories'));
    }

    public function store(CategoryRequest $request): RedirectResponse
    {
        Category::create($request->all());
        return redirect(route('home'))->with('success', 'category created successfully');
    }

    public function edit(Category $category): View
    {
        $category->findOrFail($category->id);
        $parentCategories = Category::query()->select('id', 'name')->get();
        return view('category.edit', compact('category', 'parentCategories'));
    }


    public function update(CategoryRequest $request, Category $category): RedirectResponse
    {
        $category = $category->where('id', $category->id)->update([
            'name' => $request->name,
            'description' => $request->description,
            'parent_id' => $request->parent_id
        ]);

        return redirect(route('home'))->with('success', 'category updated successfully');
    }
}
