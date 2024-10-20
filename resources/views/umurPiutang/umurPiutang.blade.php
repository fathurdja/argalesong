@extends('layouts.app')

@section('content')
    <div class="container mx-auto mt-10 ml-9">
        <!-- Search Bar -->
        <div class="mb-6">
            <form action="{{ route('detailpiutang.index') }}" method="GET">
                <input type="text" name="search" placeholder="cari kode / nama" value="{{ $search ?? '' }}"
                    class="w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm px-4 py-2">
            </form>
        </div>


        <!-- Customer Aging Report Table -->
        <div class="bg-white shadow-md rounded-lg p-6">
            <h1 class="text-2xl font-bold mb-6 ">UMUR PIUTANG</h1>
            @if (empty($grouped_data))
                <p class="text-gray-500">Silakan masukkan kode atau nama pelanggan untuk mencari data.</p>
            @elseif(empty(array_filter($grouped_data)))
                <p class="text-gray-500">Tidak ada data yang ditemukan untuk pencarian ini.</p>
            @else
                <table class="min-w-full table-auto">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kode
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama
                                Pelanggan</th>
                            <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">&lt;
                                30 Hari</th>
                            <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">&gt;
                                30 Hari</th>
                            <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">&gt;
                                60 Hari</th>
                            <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">&gt;
                                90 Hari</th>
                            <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">&gt;
                                120 Hari</th>
                            <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Total</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @php
                            $total_all = 0;
                        @endphp
                        @foreach ($grouped_data as $group_name => $items)
                            @if (!empty($items))
                                @php
                                    $subtotal = 0;
                                @endphp
                                <tr class="font-bold">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-indigo-600">
                                        {{ $group_name }}</td>
                                    <td colspan="6" class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"></td>
                                </tr>
                                @foreach ($items as $key => $item_list)
                                    @foreach ($item_list as $item)
                                        <tr class="bg-gray-50 text-sm">
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                {{ $item->no_invoice }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                {{ $item->nama_customer }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-right text-gray-900">
                                                {{ number_format($item->jhari <= 30 ? $item->nominal : 0, 0, ',', '.') }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-right text-gray-900">
                                                {{ number_format($item->jhari > 30 && $item->jhari <= 60 ? $item->nominal : 0, 0, ',', '.') }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-right text-gray-900">
                                                {{ number_format($item->jhari > 60 && $item->jhari <= 90 ? $item->nominal : 0, 0, ',', '.') }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-right text-gray-900">
                                                {{ number_format($item->jhari > 90 && $item->jhari <= 120 ? $item->nominal : 0, 0, ',', '.') }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-right text-gray-900">
                                                {{ number_format($item->jhari > 120 ? $item->nominal : 0, 0, ',', '.') }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-right text-gray-900">
                                                {{ number_format($item->nominal, 0, ',', '.') }}</td>
                                        </tr>
                                        @php
                                            $subtotal += $item->nominal;
                                            $total_all += $item->nominal;
                                        @endphp
                                    @endforeach
                                @endforeach
                                <tr class="bg-white font-bold">
                                    <td colspan="7" class="px-6 py-4 text-right">Subtotal</td>
                                    <td class="px-6 py-4 text-right">{{ number_format($subtotal, 0, ',', '.') }}</td>
                                </tr>
                            @endif
                        @endforeach
                        <!-- Total -->
                        <tr class="bg-gray-100 font-bold">
                            <td colspan="7" class="px-6 py-4 text-right">Total Seluruhnya</td>
                            <td class="px-6 py-4 text-right">{{ number_format($total_all, 0, ',', '.') }}</td>
                        </tr>
                    </tbody>

                </table>

                <!-- Buttons -->
                <div class="flex justify-between mt-6">
                    <button
                        class="px-4 py-2 bg-gray-200 text-gray-700 rounded-md shadow-sm hover:bg-gray-300">Cetak</button>
                    <button class="px-4 py-2 bg-green-500 text-white rounded-md shadow-sm hover:bg-green-600">Simpan ke
                        Excel</button>
                </div>
            @endif
        </div>
    </div>
@endsection
