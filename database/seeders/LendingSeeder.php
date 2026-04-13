<?php

namespace Database\Seeders;

use App\Models\Lending;
use App\Models\Item;
use App\Models\User;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class LendingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $item = Item::first();
        $user = User::where('role', 'admin')->first();

        if ($item && $user) {
            Lending::create([
                'item_id'     => $item->id,
                'user_id'     => $user->id,
                'name'        => 'Pak Acep',
                'total_items' => 23,
                'keterangan'  => 'Untuk ulangan harian kelas XII',
                'date'        => Carbon::now()->subDays(3),
            ]);

            Lending::create([
                'item_id'     => $item->id,
                'user_id'     => $user->id,
                'name'        => 'Bu Tri',
                'total_items' => 5,
                'keterangan'  => 'Rapat guru di aula',
                'date'        => Carbon::now()->subDays(8),
                'return_date' => Carbon::now()->subDay(),
            ]);
        }
    }
}
