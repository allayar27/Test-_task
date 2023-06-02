<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
         //\App\Models\User::factory(10)->create();
        Product::factory(3)->create([
            'name' => 'product 1',
            'price' => 123.00
        ]);

         \App\Models\User::factory()->create([
             'name' => 'Test User',
             'email' => 'test@example.com',
             'password' => Str::password(8)
         ]);


    }
}
