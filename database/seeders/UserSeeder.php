<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run()
    {
        User::create(
            [
                'name' => 'Admin Rimba Camp',
                'email' => 'admin@rimbacamp.com',
                'password' => Hash::make('rimbacamp123'),
                'role' => 'admin',
            ]
        );
    }
}
