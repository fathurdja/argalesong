@extends('layouts.app')
@section('content')
    <div class="bg-gray-100 p-6">
        <!-- Form Search dan Informasi Pelanggan -->
        <div class="mb-4">
            <input type="text" placeholder="cari kode / nama" class="border border-gray-400 p-2 w-full rounded-md mb-4">
            <div class="flex items-center justify-between bg-white p-4 rounded-md border border-gray-400">
                <div class="text-lg font-bold">PRS348</div>
                <div class="text-lg font-bold">PT Fast Food Indonesia</div>
                <input type="text" class="border border-gray-400 p-2 rounded-md">
            </div>
        </div>

        <!-- Tabel Piutang -->
        <div class="overflow-x-auto mb-6">
            <table class="min-w-full bg-white border border-gray-400">
                <thead>
                    <tr class="bg-green-500 text-white text-left">
                        <th colspan="8" class="p-2">PIUTANG</th>
                        <th colspan="8" class="text-right p-2">Periode: 01/07/2024 s/d 12/08/2024</th>
                    </tr>
                    <tr class="bg-green-300 text-black">
                        <th class="p-2 border">Tgl Terbit</th>
                        <th class="p-2 border">No Invoice</th>
                        <th class="p-2 border">No Bukti Jurnal</th>
                        <th class="p-2 border">Keterangan</th>
                        <th class="p-2 border">Nominal</th>
                        <th class="p-2 border">Tgl Jatuh Tempo</th>
                        <th class="p-2 border">Tgl Bayar</th>
                        <th class="p-2 border">No Bukti Jurnal</th>
                        <th class="p-2 border">Keterangan</th>
                        <th class="p-2 border">Nominal</th>
                        <th class="p-2 border">Saldo</th>
                        <th class="p-2 border">Umur Piutang</th>
                        <th class="p-2 border">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Repeat Rows -->
                    <tr>
                        <td class="p-2 border">29/05/2024</td>
                        <td class="p-2 border">INV024087</td>
                        <td class="p-2 border">FN024052001</td>
                        <td class="p-2 border">Sewa KFC Petarani Mei 2024</td>
                        <td class="p-2 border">23,456,000</td>
                        <td class="p-2 border">28/06/2024</td>
                        <td class="p-2 border">05/08/2024</td>
                        <td class="p-2 border">BD0240685002</td>
                        <td class="p-2 border">Pembayaran 1</td>
                        <td class="p-2 border">15,000,000</td>
                        <td class="p-2 border">0</td>
                        <td class="p-2 border">7</td>
                        <td class="p-2 border flex justify-center items-center space-x-2">
                            <button class="text-blue-500 hover:text-blue-700">
                                <!-- Ikon edit -->
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M16.862 2.488l4.65 4.65a1.5 1.5 0 010 2.121l-9.193 9.193a1.5 1.5 0 01-.736.405l-5.914 1.314a1.5 1.5 0 01-1.83-1.829l1.314-5.914a1.5 1.5 0 01.405-.736l9.193-9.193a1.5 1.5 0 012.121 0zM12.75 6.75L17.25 11.25" />
                                </svg>
                            </button>
                            <button class="text-red-500 hover:text-red-700">
                                <!-- Ikon hapus -->
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M19.5 9.75h-15M12 4.5v15m0 0L7.5 15M12 19.5l4.5-4.5m0 0l4.5-4.5m-9 9l-4.5-4.5m0 0L4.5 12m15 0l4.5-4.5M4.5 12L12 4.5" />
                                </svg>
                            </button>
                        </td>
                    </tr>
                    <!-- Repeat Rows End -->
                    <tr class="bg-green-300 font-bold text-black">
                        <td colspan="11" class="p-2 text-right">Total</td>
                        <td class="p-2 border" colspan="2">75,440,000</td>

                    </tr>
                </tbody>
            </table>
        </div>

        <!-- Tabel Denda -->
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white border border-gray-400">
                <thead>
                    <tr class="bg-red-500 text-white text-left">
                        <th colspan="6" class="p-2">DENDA</th>
                    </tr>
                    <tr class="bg-red-300 text-black">
                        <th class="p-2 border">Nominal Denda</th>
                        <th class="p-2 border">Tgl Bayar</th>
                        <th class="p-2 border">No Bukti Jurnal</th>
                        <th class="p-2 border">Keterangan</th>
                        <th class="p-2 border">Nominal</th>
                        <th class="p-2 border">Saldo</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Repeat Rows -->
                    <tr>
                        <td class="p-2 border">-</td>
                        <td class="p-2 border">-</td>
                        <td class="p-2 border">-</td>
                        <td class="p-2 border">-</td>
                        <td class="p-2 border">0</td>
                        <td class="p-2 border">0</td>
                    </tr>
                    <!-- Repeat Rows End -->
                    <tr class="bg-red-300 font-bold text-black">
                        <td colspan="5" class="p-2 text-right">Total</td>
                        <td class="p-2 border">0</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
@endsection
