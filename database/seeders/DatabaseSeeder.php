<?php
namespace Database\Seeders;
use App\Models\User;
use App\Models\Balans;
use App\Models\Setting;
use App\Models\Kassa;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder{
    public function run(): void{
        $this->call([
            UserSeeder::class,
            SettingSeeder::class,
            BalansSeeder::class,
            KassaSeeder::class,
        ]);

    }
}
