<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Testimoni;
use App\Models\User;

class TestimoniSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Pastikan ada user pengunjung untuk testimoni
        $users = User::where('role', 'pengunjung')->take(4)->get();

        if ($users->count() < 4) {
            // Buat user pengunjung jika belum ada
            for ($i = $users->count(); $i < 4; $i++) {
                $users->push(User::create([
                    'name' => 'Pengunjung ' . ($i + 1),
                    'email' => 'pengunjung' . ($i + 1) . '@example.com',
                    'password' => bcrypt('password'),
                    'role' => 'pengunjung'
                ]));
            }
        }

        $testimoniData = [
            [
                'isi' => 'Rimba Camp sangat menakjubkan! Suasana alamnya benar-benar menenangkan dan cottage-nya nyaman sekali. Pelayanannya juga ramah. Pasti akan kembali lagi dengan keluarga.',
                'status' => 'aktif',
                'user_id' => $users[0]->id
            ],
            [
                'isi' => 'Tempat yang sempurna untuk healing dari hiruk pikuk kota. Pemandangannya indah, udara segar, dan banyak spot foto menarik. Recommended banget untuk yang suka wisata alam!',
                'status' => 'aktif',
                'user_id' => $users[1]->id
            ],
            [
                'isi' => 'Pengalaman menginap di cottage Rimba Camp luar biasa. Fasilitasnya lengkap, bersih, dan lokasinya strategis untuk menjelajahi area wisata. Staff-nya juga helpful.',
                'status' => 'nonaktif',
                'user_id' => $users[2]->id
            ],
            [
                'isi' => 'Destinasi wisata yang wajib dikunjungi! Selain pemandangan yang indah, ada juga program edukasi konservasi yang menarik. Anak-anak jadi belajar tentang lingkungan sambil berlibur.',
                'status' => 'nonaktif',
                'user_id' => $users[3]->id
            ]
        ];

        foreach ($testimoniData as $data) {
            Testimoni::create($data);
        }
    }
}
