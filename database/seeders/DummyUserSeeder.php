<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DummyUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $userData = [
            [
                'name'=>'user',
                'email'=>'user@gmail.com',
                'no_hp' => '08965463748',
                'nim' => '3337220096',
                'jurusan' => 'Industri',
                'role'=>'user',
                'password'=>bcrypt('user123')
            ],

            [
                'name'=>'admin',
                'email'=>'admin@gmail.com',
                'no_hp' => '08965438448',
                'nim' => '3337220023',
                'jurusan' => 'Informatika',
                'role'=>'admin',
                'password'=>bcrypt('admin123')
            ]
        ];

        foreach($userData as $key => $val){
            User::create($val);
        }
    }
}
