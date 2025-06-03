<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Artikel;
use Illuminate\Support\Str;

class ArtikelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $artikels = [
            [
                'judul' => 'Mengenal Ekosistem Hutan Rimba Camp',
                'isi' => 'Hutan di sekitar Rimba Camp memiliki keanekaragaman hayati yang luar biasa. Terdapat berbagai jenis flora dan fauna endemik yang hidup dalam ekosistem yang seimbang. Artikel ini akan membahas tentang pentingnya menjaga kelestarian hutan dan berbagai spesies yang dapat ditemukan di area Rimba Camp. Pengunjung dapat belajar tentang interaksi antar makhluk hidup dan bagaimana setiap komponen memiliki peran penting dalam menjaga keseimbangan alam.',
                'user_id' => 1
            ],
            [
                'judul' => 'Tips Berkemah Ramah Lingkungan di Alam Terbuka',
                'isi' => 'Berkemah adalah salah satu cara terbaik untuk menikmati keindahan alam. Namun, penting untuk melakukannya dengan cara yang tidak merusak lingkungan. Artikel ini memberikan panduan lengkap tentang cara berkemah yang ramah lingkungan, mulai dari memilih lokasi yang tepat, menggunakan peralatan yang sustainable, hingga cara mengelola sampah dengan benar. Mari kita jadi traveler yang bertanggung jawab terhadap alam.',
                'user_id' => 1
            ],
            [
                'judul' => 'Konservasi Air dan Pentingnya Sumber Daya Air Bersih',
                'isi' => 'Air adalah sumber kehidupan yang sangat berharga. Di Rimba Camp, terdapat beberapa sumber mata air alami yang perlu dijaga kelestariannya. Artikel ini membahas tentang pentingnya konservasi air, cara-cara sederhana untuk menghemat penggunaan air, dan bagaimana aktivitas manusia dapat mempengaruhi kualitas sumber daya air. Pelajari juga tentang teknologi sederhana untuk menjaga kebersihan air di alam terbuka.',
                'user_id' => 1
            ],
            [
                'judul' => 'Flora dan Fauna Unik di Sekitar Rimba Camp',
                'isi' => 'Keindahan Rimba Camp tidak hanya terletak pada pemandangannya yang menakjubkan, tetapi juga pada keanekaragaman hayati yang dimilikinya. Terdapat berbagai jenis burung, kupu-kupu, dan mamalia kecil yang hidup di sekitar area ini. Artikel ini akan mengajak Anda mengenal lebih dekat berbagai spesies unik yang dapat ditemukan, beserta karakteristik dan habitat alami mereka. Dilengkapi dengan tips pengamatan wildlife yang aman dan etis.',
                'user_id' => 1
            ]
        ];

        foreach ($artikels as $artikel) {
            Artikel::create([
                'judul' => $artikel['judul'],
                'isi' => $artikel['isi'],
                'slug' => Str::slug($artikel['judul']),
                'user_id' => $artikel['user_id']
            ]);
        }
    }
}
