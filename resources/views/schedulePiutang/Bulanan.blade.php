@extends('layouts.app')

@section('content')
    <div class="container mx-auto mt-4 p-4 rounded-lg bg-white ml-11">
        <h1 class="text-2xl font-bold mb-4">SCHEDULE PIUTANG</h1>

        <!-- Year Selection -->
        <div class="flex items-center mb-4">
            <label for="year" class="mr-2 font-semibold text-gray-700">Tahun</label>
            <select id="year"
                class="border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                @foreach (range(2010, 2032) as $year)
                    <option value="{{ $year }}">{{ $year }}</option>
                @endforeach
            </select>
        </div>

        <!-- Month Tabs -->
        <div class="flex justify-between mb-4 border-b-2 border-gray-200">
            @foreach (['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'] as $key => $month)
                <div id="month-{{ $key + 1 }}" class="py-2 px-4 cursor-pointer text-gray-700 hover:text-black">
                    {{ $month }}
                </div>
            @endforeach
        </div>

        <!-- Monthly Report Table -->
        <div class="bg-white shadow-md rounded-lg p-6">
            <table class="min-w-full table-auto">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kode
                            Pelanggan</th>
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
                    <!-- Data will be populated via JavaScript -->
                </tbody>
            </table>
        </div>

        <!-- Print Button -->
        <div class="flex justify-end my-5">
            <button id="print-btn"
                class="px-4 py-2 bg-green-600 text-white rounded-md shadow-sm hover:bg-gray-300">Cetak</button>
        </div>
    </div>
@endsection

@push('scripts')
@vite('resources/js/test.js'), 
@endpush
