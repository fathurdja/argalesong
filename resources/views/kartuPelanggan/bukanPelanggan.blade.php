@extends('layouts.app')

@section('content')
    <div class="w-full flex flex-col justify-center items-start mt-5 gap-5 px-2 sm:px-6 lg:px-8 mb-10">
        <!-- Search Bar -->
        <div class="w-full">
            <input type="text" placeholder="Cari kode / nama"
                class="w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm px-4 py-2">
        </div>

        <!-- Ledger Table Section -->
        @foreach([
            ['title' => '0108.01001 PPN Masukan', 'total' => '577,009'],
            ['title' => '0105.01004 Asuransi Dibayar Di Muka', 'total' => '577,009']
        ] as $account)
        <div class="w-full bg-white shadow-md rounded-lg px-4 py-4">
            <h3 class="text-lg font-bold mb-2">{{ $account['title'] }}</h3>
            <div class="mb-2 text-sm">Periode: 01/07/2024 s/d 12/08/2024</div>

            <!-- Scroll hanya untuk layar kecil -->
            <div class=" min-w-full overflow-x-auto">
                <table class="min-w-full border-collapse">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tgl Terbit</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No Bukti Jurnal</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Keterangan</th>
                            <th class="px-4 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Debet</th>
                            <th class="px-4 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Kredit</th>
                            <th class="px-4 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Saldo</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach([
                            ['tgl' => '29/5/2024', 'no' => 'FN0240529001', 'ket' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent varius.', 'debet' => '254,545', 'kredit' => '', 'saldo' => '254,545'],
                            ['tgl' => '28/6/2024', 'no' => 'FN0240628001', 'ket' => 'Vestibulum vel metus sit amet nisi ullamcorper.', 'debet' => '67,919', 'kredit' => '', 'saldo' => '322,464']
                        ] as $entry)
                        <tr>
                            <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-500">{{ $entry['tgl'] }}</td>
                            <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-500">{{ $entry['no'] }}</td>
                            <td class="px-4 py-3 text-sm text-gray-500">{{ $entry['ket'] }}</td>
                            <td class="px-4 py-3 whitespace-nowrap text-sm text-right text-gray-500">{{ $entry['debet'] }}</td>
                            <td class="px-4 py-3 whitespace-nowrap text-sm text-right text-gray-500">{{ $entry['kredit'] }}</td>
                            <td class="px-4 py-3 whitespace-nowrap text-sm text-right text-gray-500">{{ $entry['saldo'] }}</td>
                        </tr>
                        @endforeach
                        <tr class="bg-gray-50 font-bold">
                            <td colspan="5" class="px-4 py-3 text-right">Total</td>
                            <td class="px-4 py-3 text-right">{{ $account['total'] }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        @endforeach
    </div>
@endsection
