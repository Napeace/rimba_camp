<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Reservasi;
use App\Models\User;
use App\Models\Cottage;
use Carbon\Carbon;

class ReservasiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Pastikan ada user dan cottage yang tersedia
        $users = User::where('role', '!=', 'admin')->get();
        $cottages = Cottage::where('status', 'aktif')->get();

        if ($users->isEmpty() || $cottages->isEmpty()) {
            $this->command->warn('Tidak ada user atau cottage yang tersedia untuk seeder reservasi');
            return;
        }

        $reservasiData = [
            [
                'user_id' => $users->random()->id,
                'cottage_id' => $cottages->random()->id,
                'tanggal_checkin' => Carbon::now()->addDays(5),
                'tanggal_checkout' => Carbon::now()->addDays(7),
                'status_reservasi' => 'menunggu_konfirmasi',
                'bukti_pembayaran' => 'bukti_bayar_001.jpg',
                'created_at' => Carbon::now()->subDays(2),
            ],
            [
                'user_id' => $users->random()->id,
                'cottage_id' => $cottages->random()->id,
                'tanggal_checkin' => Carbon::now()->addDays(10),
                'tanggal_checkout' => Carbon::now()->addDays(12),
                'status_reservasi' => 'disetujui',
                'bukti_pembayaran' => 'bukti_bayar_002.jpg',
                'created_at' => Carbon::now()->subDays(5),
            ],
            [
                'user_id' => $users->random()->id,
                'cottage_id' => $cottages->random()->id,
                'tanggal_checkin' => Carbon::now()->subDays(3),
                'tanggal_checkout' => Carbon::now()->subDays(1),
                'status_reservasi' => 'ditolak',
                'bukti_pembayaran' => 'bukti_bayar_003.jpg',
                'created_at' => Carbon::now()->subDays(7),
            ],
            [
                'user_id' => $users->random()->id,
                'cottage_id' => $cottages->random()->id,
                'tanggal_checkin' => Carbon::now()->addDays(15),
                'tanggal_checkout' => Carbon::now()->addDays(17),
                'status_reservasi' => 'disetujui',
                'bukti_pembayaran' => 'bukti_bayar_004.jpg',
                'created_at' => Carbon::now()->subDays(1),
            ],
        ];

        foreach ($reservasiData as $data) {
            Reservasi::create($data);
        }

        $this->command->info('4 data reservasi berhasil dibuat');
    }
}
