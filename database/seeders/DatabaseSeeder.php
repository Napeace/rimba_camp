<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            CottageSeeder::class,
            TestimoniSeeder::class,
            ArtikelSeeder::class,
            GaleriSeeder::class,
            ReservasiSeeder::class,
        ]);
    }
}
