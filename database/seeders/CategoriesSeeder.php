<?php

namespace Database\Seeders;

use App\Models\Categories;
use Illuminate\Database\Seeder;

class CategoriesSeeder extends Seeder
{
    public function run(): void
    {
        Categories::create([
            'name' => 'Elektronik',
            'division' => 'Sarpras',
            'total_items' => 40,
        ]);
        Categories::create([
            'name' => 'Alat Tulis',
            'division' => 'Tata Usaha',
            'total_items' => 20,
        ]);
        Categories::create([
            'name' => 'Peralatan Kebersihan',
            'division' => 'Tefa',
            'total_items' => 10,
        ]);
    }
}
