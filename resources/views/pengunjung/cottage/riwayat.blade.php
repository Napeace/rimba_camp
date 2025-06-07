@extends('pengunjung.layouts.app')

@section('title', 'Riwayat Reservasi Cottage - RimbaCamp')

@section('content')
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-3xl font-bold mb-6">Riwayat Reservasi Cottage</h1>

        @if ($reservasi->count() > 0)
            <div class="overflow-x-auto">
                <table class="min-w-full bg-white border border-gray-200 rounded-lg shadow-md">
                    <thead>
                        <tr class="bg-green-600 text-white">
                            <th class="py-3 px-6 text-left">No</th>
                            <th class="py-3 px-6 text-left">Nomor Cottage</th>
                            <th class="py-3 px-6 text-left">Check-in</th>
                            <th class="py-3 px-6 text-left">Check-out</th>
                            <th class="py-3 px-6 text-left">Status</th>
                            <th class="py-3 px-6 text-left">Total Harga</th>
                            <th class="py-3 px-6 text-left">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($reservasi as $index => $item)
                            <tr class="{{ $index % 2 == 0 ? 'bg-gray-50' : 'bg-white' }}">
                                <td class="py-3 px-6">{{ $reservasi->firstItem() + $index }}</td>
                                <td class="py-3 px-6">{{ $item->cottage->nomor ?? '-' }}</td>
                                <td class="py-3 px-6">
                                    {{ \Carbon\Carbon::parse($item->tanggal_checkin)->locale('id')->isoFormat('D MMMM YYYY') }}
                                </td>
                                <td class="py-3 px-6">
                                    {{ \Carbon\Carbon::parse($item->tanggal_checkout)->locale('id')->isoFormat('D MMMM YYYY') }}
                                </td>
                                <td class="py-3 px-6">
                                    <span
                                        class="inline-block px-3 py-1 rounded-full text-xs font-semibold {{ $item->status_badge_class }}">
                                        {{ $item->status_label }}
                                    </span>
                                </td>
                                <td class="py-3 px-6">Rp {{ number_format($item->total_harga, 0, ',', '.') }}</td>
                                <td class="py-3 px-6">
                                    <a href="{{ route('cottage.reservasi.show', $item->id) }}"
                                        class="text-green-600 hover:text-green-800 font-semibold">
                                        Detail
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="mt-6">
                {{ $reservasi->links() }}
            </div>
        @else
            <p class="text-gray-600">Anda belum memiliki riwayat reservasi cottage.</p>
            <a href="{{ route('cottage.index') }}"
                class="inline-block mt-4 px-6 py-3 bg-green-600 text-white rounded-lg hover:bg-green-700 transition-colors">
                Pesan Cottage Sekarang
            </a>
        @endif
    </div>
@endsection
