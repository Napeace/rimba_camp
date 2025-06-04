<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CottageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $cottages = [
            [
                'nomor' => 'C001',
                'kapasitas' => 4,
                'fasilitas' => 'Tempat Tidur, Teras, Lemari',
                'harga_per_malam' => 100000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nomor' => 'C002',
                'kapasitas' => 6,
                'fasilitas' => 'Tempat Tidur, Teras, Lemari, Dapur Kecil',
                'harga_per_malam' => 150000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nomor' => 'C003',
                'kapasitas' => 2,
                'fasilitas' => 'Tempat Tidur, Teras, Meja',
                'harga_per_malam' => 75000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nomor' => 'C004',
                'kapasitas' => 4,
                'fasilitas' => 'Tempat Tidur, Teras, Lemari, Dapur Lengkap',
                'harga_per_malam' => 150000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nomor' => 'C005',
                'kapasitas' => 4,
                'fasilitas' => 'Tempat Tidur, Teras, Lemari',
                'harga_per_malam' => 100000,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ];

        DB::table('cottages')->insert($cottages);
    }
}
