<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    public function run()
    {
        Category::insert([
            ['name' => 'All Types'],
            ['name' => 'Frizzy'],
            ['name' => 'Normal Hair'],
            ['name' => 'Colored Hair'],
        ]);
    }
}
