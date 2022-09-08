<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Tag;
use Illuminate\Database\Seeder;

class TagsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Tag::firstOrCreate(['name' => 'Топ']);
        Tag::firstOrCreate(['name' => 'Шок']);
        Tag::firstOrCreate(['name' => 'Коронавирус']);
        Tag::firstOrCreate(['name' => '18+']);
        Tag::firstOrCreate(['name' => 'Интересно']);
    }
}
