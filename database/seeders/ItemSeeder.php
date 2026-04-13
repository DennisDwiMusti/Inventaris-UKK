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
            'total'       => 35,
            'repair'      => 0,
            'lending_id'  => 35,
        ]);

        Item::create([
            'name'        => 'Printer',
            'category_id' => 1,
            'total'       => 5,
            'repair'      => 0,
            'lending_id'  => 0,
        ]);

        Item::create([
            'name'        => 'Sapu',
            'category_id' => 3,
            'total'       => 10,
            'repair'      => 0,
            'lending_id'  => 0,
        ]);

        Item::create([
            'name'        => 'Spidol',
            'category_id' => 2,
            'total'       => 20,
            'repair'      => 0,
            'lending_id'  => 0,
        ]);
    }
}
