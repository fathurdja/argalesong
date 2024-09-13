@extends('layouts.app')

@section('content')
    <div class="bg-white p-4 rounded-lg shadow-lg mt-4">

        <!-- Year and Month Selection -->
        <div class="flex justify-start items-center mb-2">
            <div class="mr-4">
                <label for="year" class="mr-2">Tahun</label>
                <select id="year" class="border border-gray-300 rounded p-1">
                    <option value="2023">2023</option>
                    <!-- Add more years as needed -->
                </select>
            </div>
            <div>
                <label for="month" class="mr-2">Bulan</label>
                <select id="month" class="border border-gray-300 rounded p-1">
                    <option value="Desember">Desember</option>
                    <!-- Add more months as needed -->
                </select>
            </div>
        </div>

        <!-- Days of the Month -->
        <div class="flex justify-start items-center mb-2 space-x-1 text-sm">
            @for ($i = 1; $i <= 31; $i++)
                <a href="">
                    <div
                        class="text-center px-1 py-1  border-gray-300 @if ($i == 17) bg-blue-100 border-2 @endif">
                        {{ $i }}
                    </div>
                </a>
            @endfor
        </div>

        <!-- Invoice Table -->
        <div class="bg-white shadow-md rounded-lg p-6">
            <table class="min-w-full table-auto">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kode</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama
                            Pelanggan</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jatuh
                            Tempo</th>
                        <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Total
                            Piutang</th>
                        <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Pembayaran</th>
                        <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Saldo
                            Piutang</th>
                    </tr>
                </thead>
                <tbody id="report-body" class="bg-white divide-y divide-gray-200 text-sm">
                    <!-- This will be populated via JavaScript -->
                </tbody>
            </table>
        </div>

        <!-- Print Button -->
        <div class="flex justify-end mt-6">
            <button class="px-4 py-2 bg-gray-200 text-gray-700 rounded-md shadow-sm hover:bg-gray-300">Cetak</button>
        </div>
    </div>
@endsection
