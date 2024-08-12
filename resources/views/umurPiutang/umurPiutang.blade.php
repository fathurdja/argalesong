@extends('layouts.app')

@section('content')
<div class="container mx-auto mt-10">
    <!-- Search Bar -->
    <div class="mb-6">
        <input type="text" placeholder="cari kode / nama" class="w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm px-4 py-2">
    </div>

    <!-- Customer Aging Report Table -->
    <div class="bg-white shadow-md rounded-lg p-6">
        <table class="min-w-full table-auto">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kode</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Pelanggan</th>
                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">&lt; 30 Hari</th>
                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">&gt; 30 Hari</th>
                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">&gt; 60 Hari</th>
                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">&gt; 90 Hari</th>
                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">&gt; 120 Hari</th>
                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Total</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                <!-- Customer 1 -->
                <tr class="font-bold">
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-indigo-600">PRS</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">PERUSAHAAN</td>
                    <td colspan="6" class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"></td>
                </tr>
                <tr class="bg-gray-50 text-sm">
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">PRS348</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">PT Fast Food Indonesia</td>
                    <td class="px-6 py-4 whitespace-nowrap text-right text-gray-900">90,440,000</td>
                    <td class="px-6 py-4 whitespace-nowrap text-right text-gray-900">0</td>
                    <td class="px-6 py-4 whitespace-nowrap text-right text-gray-900">34,123,876</td>
                    <td class="px-6 py-4 whitespace-nowrap text-right text-gray-900">0</td>
                    <td class="px-6 py-4 whitespace-nowrap text-right text-gray-900">0</td>
                    <td class="px-6 py-4 whitespace-nowrap text-right text-gray-900">124,563,876</td>
                </tr>
                <tr class="bg-white font-bold">
                    <td colspan="7" class="px-6 py-4 text-right">Subtotal</td>
                    <td class="px-6 py-4 text-right">124,563,876</td>
                </tr>
                <!-- Customer 2 -->
                <tr class="font-bold">
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-indigo-600">AFL</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">AFILIASI</td>
                    <td colspan="6" class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"></td>
                </tr>
                <tr class="bg-gray-50 text-sm">
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">AFL102</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">PT Sinar Galesong Mandiri</td>
                    <td class="px-6 py-4 whitespace-nowrap text-right text-gray-900">1,100,000</td>
                    <td class="px-6 py-4 whitespace-nowrap text-right text-gray-900">1,200,000</td>
                    <td class="px-6 py-4 whitespace-nowrap text-right text-gray-900">0</td>
                    <td class="px-6 py-4 whitespace-nowrap text-right text-gray-900">0</td>
                    <td class="px-6 py-4 whitespace-nowrap text-right text-gray-900">0</td>
                    <td class="px-6 py-4 whitespace-nowrap text-right text-gray-900">2,300,000</td>
                </tr>
                <tr class="bg-white font-bold">
                    <td colspan="7" class="px-6 py-4 text-right">Subtotal</td>
                    <td class="px-6 py-4 text-right">2,300,000</td>
                </tr>
                <!-- Total -->
                <tr class="bg-gray-100 font-bold">
                    <td colspan="7" class="px-6 py-4 text-right">Total Seluruhnya</td>
                    <td class="px-6 py-4 text-right">126,863,876</td>
                </tr>
            </tbody>
        </table>

        <!-- Buttons -->
        <div class="flex justify-between mt-6">
            <button class="px-4 py-2 bg-gray-200 text-gray-700 rounded-md shadow-sm hover:bg-gray-300">Cetak</button>
            <button class="px-4 py-2 bg-green-500 text-white rounded-md shadow-sm hover:bg-green-600">Simpan ke Excel</button>
        </div>
    </div>
</div>
@endsection
