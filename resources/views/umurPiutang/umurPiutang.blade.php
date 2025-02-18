@extends('layouts.app')

@section('content')
    <div class="container mt-14 sm:mt-10 px-2 sm:px-4 lg:mt-20">
        <!-- Search Bar -->
        <div class="mb-4 sm:mb-6">
            <form action="{{ route('umur-piutang') }}" method="GET" class="flex gap-2">
                <input type="text" name="search" placeholder="Cari berdasarkan kode atau nama" value="{{ $search ?? '' }}"
                    class="w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 text-xs sm:text-sm px-3 sm:px-4 py-2">
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
            @else
                <div class="overflow-clip sm:overflow-x-auto">
                    <!-- Table for Desktop View -->
                    <div class="hidden lg:block">
                        <table class="min-w-full table-auto border border-gray-300 text-xs sm:text-sm">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Kode</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Nama Pelanggan</th>
                                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase">&lt; 30 Hari</th>
                                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase">&gt; 30 Hari</th>
                                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase">&gt; 60 Hari</th>
                                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase">&gt; 90 Hari</th>
                                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase">&gt; 120 Hari</th>
                                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase">Total</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @php $totalKeseluruhan = 0; @endphp
                                @foreach ($grouped_data as $companyId => $companyData)
                                    <!-- Company Name Row (Desktop) -->
                                    <tr class="bg-gray-100 font-bold">
                                        <td colspan="8" class="px-6 py-3 text-left uppercase">{{ $companyId }}</td>
                                    </tr>

                                    @php $subtotal = 0; @endphp

                                    @foreach ($companyData['customers'] as $customerId => $agingData)
                                        <tr>
                                            <td class="px-6 py-3 text-gray-500">{{ $customerId }}</td>
                                            <td class="px-6 py-3 text-gray-900">{{ $agingData['customer_name'] }}</td>
                                            <td class="px-6 py-3 text-right text-gray-900">{{ number_format($agingData['< 30 days'] ?? 0, 0, ',', '.') }}</td>
                                            <td class="px-6 py-3 text-right text-gray-900">{{ number_format($agingData['> 30 days'] ?? 0, 0, ',', '.') }}</td>
                                            <td class="px-6 py-3 text-right text-gray-900">{{ number_format($agingData['> 60 days'] ?? 0, 0, ',', '.') }}</td>
                                            <td class="px-6 py-3 text-right text-gray-900">{{ number_format($agingData['> 90 days'] ?? 0, 0, ',', '.') }}</td>
                                            <td class="px-6 py-3 text-right text-gray-900">{{ number_format($agingData['> 120 days'] ?? 0, 0, ',', '.') }}</td>
                                            <td class="px-6 py-3 text-right font-bold text-gray-900">{{ number_format($agingData['total'] ?? 0, 0, ',', '.') }}</td>
                                        </tr>
                                        @php $subtotal += $agingData['total']; @endphp
                                    @endforeach

                                    <!-- Subtotal Row (Desktop) -->
                                    <tr class="font-bold bg-gray-100">
                                        <td colspan="8" class="px-6 py-3 text-right">Subtotal: {{ number_format($subtotal, 0, ',', '.') }}</td>
                                    </tr>

                                    @php $totalKeseluruhan += $subtotal; @endphp
                                @endforeach
                            </tbody>

                            <tfoot>
                                <!-- Total Row (Desktop) -->
                                <tr class="font-bold bg-gray-200">
                                    <td colspan="7" class="px-6 py-3 text-right">Total Seluruhnya</td>
                                    <td class="px-6 py-3 text-right">{{ number_format($totalKeseluruhan, 0, ',', '.') }}</td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>

                    <!-- Table for Mobile View -->
                    <div class="lg:hidden bg-white shadow-md rounded-lg">
                        @foreach ($grouped_data as $companyId => $companyData)
                            <div class="bg-gray-100 font-bold mb-4">
                                <div class="px-2 py-2">{{ $companyId }}</div>
                            </div>
                    
                            @php $subtotal = 0; @endphp
                    
                            @foreach ($companyData['customers'] as $customerId => $agingData)
                                <div class="border-b-2 border-gray-200 mb-4">
                                    <div class="px-4 py-3">
                                        <div class="flex justify-between">
                                            <span class="font-semibold">{{ $agingData['customer_name'] }}</span>
                                            <span class="font-bold">{{ number_format($agingData['total'] ?? 0, 0, ',', '.') }}</span>
                                        </div>
                                        <div class="flex justify-between text-lg mt-5">
                                            <span>&lt; 30 Hari: {{ number_format($agingData['< 30 days'] ?? 0, 0, ',', '.') }}</span>
                                            <span>&gt; 30 Hari: {{ number_format($agingData['> 30 days'] ?? 0, 0, ',', '.') }}</span>
                                        </div>
                                        <div class="flex justify-between text-lg">
                                            <span>&gt; 60 Hari: {{ number_format($agingData['> 60 days'] ?? 0, 0, ',', '.') }}</span>
                                            <span>&gt; 90 Hari: {{ number_format($agingData['> 90 days'] ?? 0, 0, ',', '.') }}</span>
                                        </div>
                                        <div class="flex justify-between text-lg">
                                            <span>&gt; 120 Hari: {{ number_format($agingData['> 120 days'] ?? 0, 0, ',', '.') }}</span>
                                        </div>
                                    </div>
                                </div>
                                @php $subtotal += $agingData['total']; @endphp
                            @endforeach
                    
                            <!-- Subtotal Row (Mobile) -->
                            <div class="font-bold bg-gray-100 mb-4">
                                <div class="px-4 py-3 text-right">Subtotal: {{ number_format($subtotal, 0, ',', '.') }}</div>
                            </div>
                    
                        @endforeach
                    
                        <!-- Total Row (Mobile) -->
                        <div class="font-bold bg-gray-200">
                            <div class="px-4 py-3 text-right">Total Seluruhnya: {{ number_format($totalKeseluruhan, 0, ',', '.') }}</div>
                        </div>
                    </div>
                    
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
