@extends('layouts.app')
@section('content')
    <div class="container mx-auto ml-11 bg-white">

        <div class="overflow-x-auto py-10 px-6">
            <h1 class="text-xl font-bold mb-4">Halaman Riwayat Pembayaran Piutang</h1>
            <table class="min-w-full bg-white border border-gray-300">
                <thead>
                    <tr>
                        <th class="px-4 py-2 border border-gray-300">ID Pembayaran</th>
                        <th class="px-4 py-2 border border-gray-300">Nama Pelanggan</th>
                        <th class="px-4 py-2 border border-gray-300">Mode Pembayaran</th>
                        <th class="px-4 py-2 border border-gray-300">Total Semua Piutang</th>
                        <th class="px-4 py-2 border border-gray-300">Nominal yang Dibayar</th>
                        <th class="px-4 py-2 border border-gray-300">Sisa</th>
                        <th class="px-4 py-2 border border-gray-300">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($riwayatPembayaran as $riwayat)
                        <tr>
                            <td class="px-4 py-2 border border-gray-300">{{ $riwayat->IDPembayaran }}</td>
                            <td class="px-4 py-2 border border-gray-300">{{ $riwayat->NamaPelanggan }}</td>
                            <td class="px-4 py-2 border border-gray-300">{{ $riwayat->ModePembayaran }}</td>
                            <td class="px-4 py-2 border border-gray-300 text-right">
                                Rp{{ number_format($riwayat->TotalSemuaPiutang, 0, ',', '.') }}</td>
                            <td class="px-4 py-2 border border-gray-300 text-right">
                                Rp{{ number_format($riwayat->NominalyangDibayar, 0, ',', '.') }}</td>
                            <td class="px-4 py-2 border border-gray-300 text-right">
                                Rp{{ number_format($riwayat->Sisa, 0, ',', '.') }}
                            </td>
                            <td class="px-4 py-2 border border-gray-300 text-blue-500 cursor-pointer">
                                <a href="">Details</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-4 py-2 border border-gray-300 text-center">
                                Tidak ada data riwayat pembayaran.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
