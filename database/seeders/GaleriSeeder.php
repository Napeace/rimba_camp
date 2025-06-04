<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Galeri;
use App\Models\User;

class GaleriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Ambil user admin pertama atau buat default
        $adminUser = User::where('role', 'admin')->first();

        if (!$adminUser) {
            $adminUser = User::create([
                'name' => 'Admin',
                'email' => 'admin@rimbacamp.com',
                'password' => bcrypt('password'),
                'role' => 'admin',
                'email_verified_at' => now(),
            ]);
        }

        $galeriData = [
            [
                'nama_file' => 'galeririmbacamp1.png',
                'deskripsi' => 'Suasana Rimba Camp yang asri dengan tenda-tenda di tepi sungai dan deretan cottage unik berlatar hutan dan pegunungan. Cocok untuk pengalaman berkemah dan liburan alam yang tenang.',
                'user_id' => $adminUser->id,
            ],
            [
                'nama_file' => 'galeririmbacamp2.png',
                'deskripsi' => 'Deretan tenda merah yang berdiri rapi di tepi sungai berbatu, dikelilingi hutan lebat dan suasana alam yang tenang, cocok untuk pengalaman berkemah yang autentik di alam terbuka.',
                'user_id' => $adminUser->id,
            ],
            [
                'nama_file' => 'galeririmbacamp3.png',
                'deskripsi' => 'Jembatan bambu ikonik dengan latar deretan kabin kayu dan aliran sungai yang jernih, spot favorit untuk berfoto dan menikmati suasana alami Rimba Camp.',
                'user_id' => $adminUser->id,
            ],
            [
                'nama_file' => 'galeririmbacamp4.png',
                'deskripsi' => 'Deretan kabin dengan desain segitiga modern berdiri kokoh di atas fondasi batu alam, berpadu dengan hijaunya pepohonan dan aliran air yang jernih—menyuguhkan suasana nyaman dan sejuk khas pegunungan di Rimba Camp.',
                'user_id' => $adminUser->id,
            ],
        ];

        foreach ($galeriData as $data) {
            Galeri::create($data);
        }
    }
}
