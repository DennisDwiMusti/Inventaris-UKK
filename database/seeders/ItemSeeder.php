<?php

namespace Database\Seeders;

use App\Models\Item;
use Illuminate\Database\Seeder;

class ItemSeeder extends Seeder
{
    public function run(): void
    {
        Item::create([
            'name'        => 'Laptop',
            'category_id' => 1,
            'total'       => 5,
            'repair'      => 0,
            'lending_id'  => 1,
        ]);

        Item::create([
            'name'        => 'Printer',
            'category_id' => 1,
            'total'       => 3,
            'repair'      => 0,
            'lending_id'  => 1,
        ]);

        Item::create([
            'name'        => 'Sapu',
            'category_id' => 3,
            'total'       => 50,
            'repair'      => 0,
            'lending_id'  => 1,
        ]);
    }
}
