@extends('layouts.app')

@section('content')
    <div class="container mx-auto mt-10 ml-9">
        <!-- Search Bar -->
        <div class="mb-6">
            <form action="{{ route('umur-piutang') }}" method="GET">
                <input type="text" name="search" placeholder="Search for code / name" value="{{ $search ?? '' }}"
                    class="w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm px-4 py-2">
            </form>
        </div>

        <!-- Customer Aging Summary Table -->
        <div class="bg-white shadow-md rounded-lg p-6 mb-10">
            <h1 class="text-2xl font-bold mb-6">UMUR PIUTANG</h1>

            @if (empty($grouped_data) || count($grouped_data) === 0)
                <p class="text-gray-500">No data was found for this search.</p>
            @else
                <div class="min-w-full overflow-x-auto">
                    <table class="min-w-full table-auto border-collapse border border-gray-300 ">
                        <thead class="bg-gray-50">
                            <tr class="border border-gray-300 ">
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kode
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama
                                    Pelanggan</th>
                                <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    < 30 Hari</th>
                                <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">> 30
                                    Hari</th>
                                <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">> 60
                                    Hari</th>
                                <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">> 90
                                    Hari</th>
                                <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">>
                                    120 Hari</th>
                                <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Total</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @php $totalKeseluruhan = 0; @endphp
                            @foreach ($grouped_data as $companyId => $companyData)
                                <!-- Nama Perusahaan -->
                                <tr class="bg-gray-100 font-bold">
                                    <td colspan="8" class="px-6 py-3 text-left text-sm uppercase">{{ $companyId }}</td>
                                </tr>
                                @php $subtotal = 0; @endphp
    
                                @foreach ($companyData['customers'] as $customerId => $agingData)
                                    <tr>
                                        <td class="px-6 py-4 text-sm text-gray-500">{{ $customerId }}</td>
                                        <td class="px-6 py-4 text-sm text-gray-900">{{ $agingData['customer_name'] }}</td>
                                        <td class="px-6 py-4 text-right text-gray-900">
                                            {{ number_format($agingData['< 30 days'] ?? 0, 0, ',', '.') }}</td>
                                        <td class="px-6 py-4 text-right text-gray-900">
                                            {{ number_format($agingData['> 30 days'] ?? 0, 0, ',', '.') }}</td>
                                        <td class="px-6 py-4 text-right text-gray-900">
                                            {{ number_format($agingData['> 60 days'] ?? 0, 0, ',', '.') }}</td>
                                        <td class="px-6 py-4 text-right text-gray-900">
                                            {{ number_format($agingData['> 90 days'] ?? 0, 0, ',', '.') }}</td>
                                        <td class="px-6 py-4 text-right text-gray-900">
                                            {{ number_format($agingData['> 120 days'] ?? 0, 0, ',', '.') }}</td>
                                        <td class="px-6 py-4 text-right text-gray-900 font-bold">
                                            {{ number_format($agingData['total'] ?? 0, 0, ',', '.') }}</td>
                                    </tr>
                                    @php $subtotal += $agingData['total']; @endphp
                                @endforeach
    
                                <!-- Subtotal Perusahaan -->
                                <tr class="font-bold bg-gray-100">
                                    <td colspan="7" class="px-6 py-4 text-right">Subtotal</td>
                                    <td class="px-6 py-4 text-right">{{ number_format($subtotal, 0, ',', '.') }}</td>
                                </tr>
    
                                @php $totalKeseluruhan += $subtotal; @endphp
                            @endforeach
                        </tbody>
    
                        <!-- Total Seluruhnya -->
                        <tfoot>
                            <tr class="font-bold bg-gray-200">
                                <td colspan="7" class="px-6 py-4 text-right">Total Seluruhnya</td>
                                <td class="px-6 py-4 text-right">{{ number_format($totalKeseluruhan, 0, ',', '.') }}</td>
                            </tr>
                        </tfoot>
                    </table>
                </div>

                <!-- Action Buttons -->
                <div class="flex justify-between mt-6">
                    <button
                        class="active:scale-[.95] hover:text-white hover:bg-[#312D2D] bg-white font-medium transition-all border-2 border-[#312D2D] rounded-md shadow-sm px-4 py-1 hover:bg-[#312D2D]">Print</button>
                    <button class="active:scale-[.95] hover:bg-white hover:text-[#0F8114] transition-all text-white font-medium border-2 border-[#0F8114] rounded-md shadow-sm px-4 py-1 bg-[#0F8114]">Save to
                        Excel</button>
                </div>
            @endif
        </div>
    </div>
@endsection
