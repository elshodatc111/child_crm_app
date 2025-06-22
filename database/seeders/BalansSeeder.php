<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Balans;
class BalansSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Balans::create([
            'naqt' => 0,
            'plastik' => 0,
            'exson_naqt' => 0,
            'exson_plastik' => 0,
            'exson_foiz' => 0,
        ]);
    }
}
