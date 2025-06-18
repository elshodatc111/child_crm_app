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
                'email' => 'ktarbiyachi@gmail.com',
                'password' => Hash::make('password'),
            ],
        ];
        foreach ($users as $user) {
            User::create($user);
        }
    }
}
