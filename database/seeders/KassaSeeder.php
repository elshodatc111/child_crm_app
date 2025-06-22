<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Kassa;
class KassaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Kassa::create([
            'naqt' => 0,
            'naqt_chiqim' => 0,
            'naqt_xarajat' => 0,
            'plastik' => 0,
            'plastik_chiqim' => 0,
            'plastik_xarajat' => 0,
        ]);
    }
}
