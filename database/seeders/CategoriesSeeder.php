<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::firstOrCreate(['name' => 'Политика']);
        Category::firstOrCreate(['name' => 'Искусство']);
        Category::firstOrCreate(['name' => 'Развлечения']);
        Category::firstOrCreate(['name' => 'Кино']);
        Category::firstOrCreate(['name' => 'Спорт']);
        Category::firstOrCreate(['name' => 'Наука']);

    }
}
