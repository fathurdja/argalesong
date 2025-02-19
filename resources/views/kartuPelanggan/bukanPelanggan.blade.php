@extends('layouts.app')

@section('content')
    <div class="w-full flex flex-col justify-center items-start mt-14 lg:mt-20 gap-5 px-2 sm:px-6 lg:px-8 mb-10">
        <!-- Search Bar -->
        <div class="w-full flex gap-2">
            <input type="text" placeholder="Cari kode / nama"
                class="w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm px-4 py-2">
            <button type="submit"
                class="active:scale-[.95] hover:bg-white hover:text-[#3D5AD0] transition-all font-medium text-white border-2 border-[#3D5AD0] rounded-md shadow-sm px-4 py-1 bg-[#3D5AD0]">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="currentColor" d="m19.6 21l-6.3-6.3q-.75.6-1.725.95T9.5 16q-2.725 0-4.612-1.888T3 9.5t1.888-4.612T9.5 3t4.613 1.888T16 9.5q0 1.1-.35 2.075T14.7 13.3l6.3 6.3zM9.5 14q1.875 0 3.188-1.312T14 9.5t-1.312-3.187T9.5 5T6.313 6.313T5 9.5t1.313 3.188T9.5 14"/></svg>
            </button>
        </div>

        <!-- Ledger Table Section -->
        @foreach([
            ['title' => '0108.01001 PPN Masukan', 'total' => '577,009'],
            ['title' => '0105.01004 Asuransi Dibayar Di Muka', 'total' => '577,009']
        ] as $account)
        <div class="w-full lg:bg-white shadow-md rounded-lg px-4 py-4">
            <h3 class="text-lg font-bold mb-2">{{ $account['title'] }}</h3>
            <div class="mb-2 text-sm">Periode: 01/07/2024 s/d 12/08/2024</div>

            <!-- Scroll hanya untuk layar kecil -->
            <div class="min-w-full overflow-x-auto">
                <!-- Table for Laptop (Desktop View) -->
                <div class="hidden lg:block">
                    <table class="min-w-full table-auto">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Tgl Terbit</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">No Bukti Jurnal</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Keterangan</th>
                                <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase">Debet</th>
                                <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase">Kredit</th>
                                <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase">Saldo</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200 text-sm">
                            @foreach([
                                ['tgl' => '29/5/2024', 'no' => 'FN0240529001', 'ket' => 'Lorem ipsum dolor sit amet.', 'debet' => '254,545', 'kredit' => '', 'saldo' => '254,545'],
                                ['tgl' => '28/6/2024', 'no' => 'FN0240628001', 'ket' => 'Vestibulum vel metus sit amet.', 'debet' => '67,919', 'kredit' => '', 'saldo' => '322,464']
                            ] as $entry)
                            <tr>
                                <td class="px-6 py-4">{{ $entry['tgl'] }}</td>
                                <td class="px-6 py-4">{{ $entry['no'] }}</td>
                                <td class="px-6 py-4">{{ $entry['ket'] }}</td>
                                <td class="px-6 py-4 text-right">{{ $entry['debet'] }}</td>
                                <td class="px-6 py-4 text-right">{{ $entry['kredit'] }}</td>
                                <td class="px-6 py-4 text-right">{{ $entry['saldo'] }}</td>
                            </tr>
                            @endforeach
                            <tr class="bg-gray-50 font-bold">
                                <td colspan="5" class="px-6 py-4 text-right">Total</td>
                                <td class="px-6 py-4 text-right">{{ $account['total'] }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <!-- Table for Mobile & Tablet (Mobile View) -->
                <div class="lg:hidden bg-white shadow-lg space-y-8 rounded-lg text-lg lg:p-6 overflow-auto">
                    <div class="space-y-4 mb-5">
                        @foreach([
                            ['tgl' => '29/5/2024', 'no' => 'FN0240529001', 'ket' => 'Lorem ipsum dolor sit amet.', 'debet' => '254,545', 'kredit' => '', 'saldo' => '254,545'],
                            ['tgl' => '28/6/2024', 'no' => 'FN0240628001', 'ket' => 'Vestibulum vel metus sit amet.', 'debet' => '67,919', 'kredit' => '', 'saldo' => '322,464']
                        ] as $entry)
                        <div class="border-b-2 border-gray-200 pb-4">
                            <div class="flex justify-between text-lg font-semibold py-2 px-2">
                                <div class="flex-1">Tanggal Terbit: {{ $entry['tgl'] }}</div>
                                <div class="flex-1 text-right">{{ $entry['debet'] }}</div>
                            </div>
                            <div class="flex justify-between text-lg py-1 px-4">
                                <div class="flex-1 text-gray-600">No Bukti: {{ $entry['no'] }}</div>
                                <div class="flex-1 text-gray-600">Kredit: {{ $entry['kredit'] }}</div>
                            </div>
                            <div class="justify-between text-lg py-1 px-4">
                                <div class=" text-gray-600">Keterangan: {{ $entry['ket'] }}</div>
                                <div class="text-right font-bold text-lg text-black mt-5">Saldo: {{ $entry['saldo'] }}</div>
                            </div>
                        </div>
                        @endforeach
                        <div class="flex justify-between text-lg font-bold py-3 px-4 bg-gray-50">
                            <span>Total</span>
                            <span>{{ $account['total'] }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
@endsection
