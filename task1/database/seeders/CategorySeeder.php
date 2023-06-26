<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;
class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $category1 = Category::create([
            'name' => 'Общество',
        ]);

        $category2 = Category::create([
            'name' => 'День города',
        ]);

        $category3 = Category::create([
            'name' => 'Спорт',
        ]);


    }
}
