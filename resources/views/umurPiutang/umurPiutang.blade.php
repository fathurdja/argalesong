@extends('layouts.app')

@section('content')
    <div class="container mt-6 sm:mt-12 px-2 sm:px-4">
        <!-- Search Bar -->
        <div class="mb-4 sm:mb-6">
            <form action="{{ route('umur-piutang') }}" method="GET" class="flex gap-2">
                <input type="text" name="search" placeholder="Cari berdasarkan kode atau nama" value="{{ $search ?? '' }}"
            <form action="{{ route('umur-piutang') }}" method="GET" class="flex gap-2">
                <input type="text" name="search" placeholder="Cari berdasarkan kode atau nama" value="{{ $search ?? '' }}"
                    class="w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 text-xs sm:text-sm px-3 sm:px-4 py-2">
                    <button type="submit"
                        class="active:scale-[.95] hover:bg-white hover:text-[#3D5AD0] transition-all font-medium text-white border-2 border-[#3D5AD0] rounded-md shadow-sm px-4 py-1 bg-[#3D5AD0]">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="currentColor" d="m19.6 21l-6.3-6.3q-.75.6-1.725.95T9.5 16q-2.725 0-4.612-1.888T3 9.5t1.888-4.612T9.5 3t4.613 1.888T16 9.5q0 1.1-.35 2.075T14.7 13.3l6.3 6.3zM9.5 14q1.875 0 3.188-1.312T14 9.5t-1.312-3.187T9.5 5T6.313 6.313T5 9.5t1.313 3.188T9.5 14"/></svg>
                    </button>
                    <button type="submit"
                        class="active:scale-[.95] hover:bg-white hover:text-[#3D5AD0] transition-all font-medium text-white border-2 border-[#3D5AD0] rounded-md shadow-sm px-4 py-1 bg-[#3D5AD0]">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="currentColor" d="m19.6 21l-6.3-6.3q-.75.6-1.725.95T9.5 16q-2.725 0-4.612-1.888T3 9.5t1.888-4.612T9.5 3t4.613 1.888T16 9.5q0 1.1-.35 2.075T14.7 13.3l6.3 6.3zM9.5 14q1.875 0 3.188-1.312T14 9.5t-1.312-3.187T9.5 5T6.313 6.313T5 9.5t1.313 3.188T9.5 14"/></svg>
                    </button>
            </form>
        </div>

        <!-- Customer Aging Summary Table -->
        <div class="bg-white shadow-md rounded-lg p-3 sm:p-6 mb-10">
            <h1 class="text-lg sm:text-2xl font-bold mb-4 sm:mb-6">UMUR PIUTANG</h1>

            @if (empty($grouped_data) || count($grouped_data) === 0)
                <p class="text-gray-500">Data tidak ditemukan!</p>
                <p class="text-gray-500">Data tidak ditemukan!</p>
            @else
                <div class="overflow-clip sm:overflow-x-auto">
                    <table class="min-w-full table-auto border border-gray-300 text-xs sm:text-sm">
                        <thead class="bg-gray-50">
                            <tr class="border border-gray-300">
                                <th class="px-2 py-2 sm:px-4 sm:py-3 text-left font-medium text-gray-500 uppercase">Kode
                                </th>
                                <th class="px-2 py-2 sm:px-4 sm:py-3 text-left font-medium text-gray-500 uppercase">Nama
                                    Pelanggan</th>
                                <th
                                    class="px-2 py-2 sm:px-4 sm:py-3 text-right font-medium text-gray-500 hidden sm:table-cell uppercase">
                                    &lt; 30 Hari</th>
                                <th
                                    class="px-2 py-2 sm:px-4 sm:py-3 text-right font-medium text-gray-500 hidden sm:table-cell uppercase">
                                    &gt; 30 Hari</th>
                                <th
                                    class="px-2 py-2 sm:px-4 sm:py-3 text-right font-medium text-gray-500 hidden sm:table-cell uppercase">
                                    &gt; 60 Hari</th>
                                <th
                                    class="px-2 py-2 sm:px-4 sm:py-3 text-right font-medium text-gray-500 hidden sm:table-cell uppercase">
                                    &gt; 90 Hari</th>
                                <th
                                    class="px-2 py-2 sm:px-4 sm:py-3 text-right font-medium text-gray-500 hidden sm:table-cell uppercase">
                                    &gt; 120 Hari</th>
                                <th class="px-2 py-2 sm:px-4 sm:py-3 text-right font-medium text-gray-500 uppercase">Total
                                </th>
                                <th
                                    class="px-2 py-2 sm:px-4 sm:py-3 text-right font-medium sm:hidden table-cell text-gray-500 uppercase">
                                    Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @php $totalKeseluruhan = 0; @endphp
                            @foreach ($grouped_data as $companyId => $companyData)
                                <!-- Baris untuk layar besar (sm ke atas) -->
                                <tr class="bg-gray-100 font-bold hidden sm:table-row">
                                    <td colspan="8" class="px-2 sm:px-4 py-2 sm:py-3 text-left uppercase">
                                        {{ $companyId }}</td>
                                </tr>

                                <!-- Baris untuk layar handphone (di bawah sm) -->
                                <tr class="bg-gray-100 font-bold sm:hidden">
                                    <td colspan="4" class="px-2 sm:px-4 py-2 sm:py-3 text-left uppercase">
                                        {{ $companyId }}</td>
                                </tr>

                                @php $subtotal = 0; @endphp

                                @foreach ($companyData['customers'] as $customerId => $agingData)
                                    <tr>
                                        <td class="px-2 sm:px-4 py-2 sm:py-3 text-gray-500">{{ $customerId }}</td>
                                        <td class="px-2 sm:px-4 py-2 sm:py-3 text-gray-900">
                                            {{ $agingData['customer_name'] }}</td>
                                        <td class="px-2 sm:px-4 py-2 sm:py-3 hidden sm:table-cell text-right text-gray-900">
                                            {{ number_format($agingData['< 30 days'] ?? 0, 0, ',', '.') }}
                                        </td>
                                        <td class="px-2 sm:px-4 py-2 sm:py-3 hidden sm:table-cell text-right text-gray-900">
                                            {{ number_format($agingData['> 30 days'] ?? 0, 0, ',', '.') }}
                                        </td>
                                        <td class="px-2 sm:px-4 py-2 sm:py-3 hidden sm:table-cell text-right text-gray-900">
                                            {{ number_format($agingData['> 60 days'] ?? 0, 0, ',', '.') }}
                                        </td>
                                        <td class="px-2 sm:px-4 py-2 sm:py-3 hidden sm:table-cell text-right text-gray-900">
                                            {{ number_format($agingData['> 90 days'] ?? 0, 0, ',', '.') }}
                                        </td>
                                        <td class="px-2 sm:px-4 py-2 sm:py-3 hidden sm:table-cell text-right text-gray-900">
                                            {{ number_format($agingData['> 120 days'] ?? 0, 0, ',', '.') }}
                                        </td>
                                        <td class="px-2 sm:px-4 py-2 sm:py-3 text-right font-bold text-gray-900">
                                            {{ number_format($agingData['total'] ?? 0, 0, ',', '.') }}
                                        </td>
                                        <td
                                            class="px-2 sm:px-4 py-2 sm:py-3 text-right text-gray-900 sm:hidden table-cell font-bold">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48" class="w-4 mx-auto">
                                                <path fill="#2196f3" d="M17.1 5L14 8.1L29.9 24L14 39.9l3.1 3.1L36 24z" />
                                            </svg>
                                        </td>
                                    </tr>
                                    @php $subtotal += $agingData['total']; @endphp
                                @endforeach
                                <!-- Baris untuk layar besar (sm ke atas) -->
                                <tr class="font-bold bg-gray-100 hidden sm:table-row">
                                    <td colspan="8" class="px-2 sm:px-4 py-2 sm:py-3 text-left sm:text-right">Subtotal:
                                        {{ number_format($subtotal, 0, ',', '.') }}</td>
                                </tr>
                                <!-- Baris untuk layar handphone (di bawah sm) -->
                                <tr class="font-bold bg-gray-100 sm:hidden">
                                    <td colspan="4" class="px-2 sm:px-4 py-2 sm:py-3 text-left sm:text-right">Subtotal:
                                        {{ number_format($subtotal, 0, ',', '.') }}</td>
                                </tr>

                                @php $totalKeseluruhan += $subtotal; @endphp
                            @endforeach
                        </tbody>

                        <tfoot>
                             <!-- Baris untuk layar besar (sm ke atas) -->
                            <tr class="font-bold bg-gray-200 hidden sm:table-row">
                                <td colspan="7" class="px-2 sm:px-4 py-2 sm:py-3 text-right">Total Seluruhnya</td>
                                <td class="px-2 sm:px-4 py-2 sm:py-3 text-right">
                                    {{ number_format($totalKeseluruhan, 0, ',', '.') }}</td>
                            </tr>
                            <!-- Baris untuk layar handphone (di bawah sm) -->
                            <tr class="font-bold bg-gray-200 sm:hidden">
                                <td colspan="2" class="px-2 sm:px-4 py-2 sm:py-3 text-right">Total Seluruhnya</td>
                                <td colspan="2" class="px-2 sm:px-4 py-2 sm:py-3 text-right">
                                    {{ number_format($totalKeseluruhan, 0, ',', '.') }}</td>
                            </tr>

                        </tfoot>
                    </table>
                </div>

                <!-- Action Buttons -->
                <div class="flex flex-col sm:flex-row justify-between mt-6 space-y-2 sm:space-y-0">
                    <button
                        class="w-full sm:w-auto active:scale-[.95] hover:bg-[#312D2D] bg-white font-medium transition-all border-2 border-[#312D2D] rounded-md shadow-sm px-4 py-2">
                        Print
                    </button>
                    <button
                        class="w-full sm:w-auto active:scale-[.95] hover:bg-white hover:text-[#0F8114] transition-all text-white font-medium border-2 border-[#0F8114] rounded-md shadow-sm px-4 py-2 bg-[#0F8114]">
                        Save to Excel
                    </button>
                </div>
            @endif
        </div>
    </div>
@endsection
