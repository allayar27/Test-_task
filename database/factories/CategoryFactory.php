<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class CategoryFactory extends Factory
{
  
    protected $model = Category::class;

    public function definition(): array
    {
        return [
            'name' => fake()->word(),
            'description' => fake()->sentence(),
        ];
    }


    public function configure()
    {
        return $this->afterCreating(function (Category $category) {
            $parentCategory = Category::inRandomOrder()->first();

            $category->parent()->associate($parentCategory)->save();

            $productCount = rand(1, 5);
            $products = Product::factory()->count($productCount)->create();

            $category->products()->saveMany($products);
        });
    }
}
