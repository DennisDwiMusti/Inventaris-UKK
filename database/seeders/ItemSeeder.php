<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Item;
use Illuminate\Database\Seeder;

class ItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Item::create([
            'name'       => 'Laptop',
            'category'   => 'Elektronik',
            'total'      => 5,
            'repair'     => 0,
            'lending_id' => 1,
        ]);

        Item::create([
            'name'       => 'Printer',
            'category'   => 'Elektronik',
            'total'      => 3,
            'repair'     => 0,
            'lending_id' => 2,
        ]);

        Item::create([
            'name'       => 'Sapu',
            'category'   => 'Alat Dapur',
            'total'      => 50,
            'repair'     => 0,
            'lending_id' => 3,
        ]);
    }
}
