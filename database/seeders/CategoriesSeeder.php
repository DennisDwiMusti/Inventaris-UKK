<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Categories;
use Illuminate\Database\Seeder;

class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Categories::create([
            'name' => 'Elektronik',
            'division' => 'Sarpras',
            'total-items' => 10,
        ]);
        Categories::create([
            'name' => 'Alat Tulis',
            'division' => 'Tata Usaha',
            'total-items' => 20,
        ]);
        Categories::create([
            'name' => 'Peralatan Kebersihan',
            'division' => 'Tefa',
            'total-items' => 15,
        ]);
    }
}
