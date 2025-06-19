<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder{
    public function run(): void{
        $users = [
            [
                'fio' => 'Ali Valiyev',
                'phone' => '998901234567',
                'address' => 'Toshkent sh.',
                'commit' => 'Drektor',
                'type' => 'direktor',
                'status' => 'active',
                'tkun' => '01.01.1997',
                'email' => 'drektor@gmail.com',
                'password' => Hash::make('password'),
            ],
            [
                'FIO' => 'Dilnoza Karimova',
                'phone' => '998909876543',
                'address' => 'Samarqand',
                'commit' => 'Tarbiyachi',
                'type' => 'tarbiyachi',
                'status' => 'active',
                'tkun' => '01.01.1997',
                'email' => 'tarbiyachi@gmail.com',
                'password' => Hash::make('password'),
            ],
            [
                'FIO' => 'Bahrom Toshpo‘latov',
                'phone' => '998938888888',
                'address' => 'Andijon',
                'commit' => 'Oshpaz',
                'type' => 'oshpaz',
                'status' => 'active',
                'tkun' => '01.01.1997',
                'email' => 'oshpaz@gmail.com',
                'password' => Hash::make('password'),
            ],
            [
                'FIO' => 'Bahromva Sabina',
                'phone' => '998938888888',
                'address' => 'Andijon',
                'commit' => 'Kichik Tarbiyachi',
                'type' => 'kichik_tarbiyachi',
                'status' => 'active',
                'tkun' => '01.01.1997',
                'email' => 'ktarbiyachi@gmail.com',
                'password' => Hash::make('password'),
            ],
        ];
        foreach ($users as $user) {
            User::create($user);
        }
    }
}
