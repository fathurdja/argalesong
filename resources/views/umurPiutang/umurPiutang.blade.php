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
                <table class="min-w-full table-auto">
                    <thead class="bg-gray-50">
                        <tr>

                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                ID Pelanggan</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Customer Name</th>
                            <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                                < 30 Days</th>
                            <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">> 30
                                Days</th>
                            <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">> 60
                                Days</th>
                            <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">> 90
                                Days</th>
                            <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">>
                                120 Days</th>
                            <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Total</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($grouped_data as $customerId => $agingData)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ $customerId }} <!-- Nama pelanggan -->
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ $agingData['customer_name'] }} <!-- Nama pelanggan -->
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-gray-900">
                                    {{ number_format($agingData['< 30 days'] ?? 0, 0, ',', '.') }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-gray-900">
                                    {{ number_format($agingData['> 30 days'] ?? 0, 0, ',', '.') }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-gray-900">
                                    {{ number_format($agingData['> 60 days'] ?? 0, 0, ',', '.') }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-gray-900">
                                    {{ number_format($agingData['> 90 days'] ?? 0, 0, ',', '.') }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-gray-900">
                                    {{ number_format($agingData['> 120 days'] ?? 0, 0, ',', '.') }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-gray-900 font-bold">
                                    {{ number_format($agingData['total'] ?? 0, 0, ',', '.') }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    <!-- Summary Totals -->
                    <tfoot>
                        <tr class="font-bold bg-gray-100">
                            <td colspan="7" class="px-6 py-4 text-right">Subtotal</td>
                            <td class="px-6 py-4 text-right">
                                {{ number_format($totalsByCategory['total'] ?? 0, 0, ',', '.') }}</td>
                        </tr>
                        <tr class="font-bold bg-gray-100">
                            <td colspan="7" class="px-6 py-4 text-right">Total Seluruhnya</td>
                            <td class="px-6 py-4 text-right">
                                {{ number_format($totalsByCategory['total'] ?? 0, 0, ',', '.') }}</td>
                        </tr>
                    </tfoot>
                </table>

                <!-- Action Buttons -->
                <div class="flex justify-between mt-6">
                    <button
                        class="px-4 py-2 bg-gray-200 text-gray-700 rounded-md shadow-sm hover:bg-gray-300">Print</button>
                    <button class="px-4 py-2 bg-green-500 text-white rounded-md shadow-sm hover:bg-green-600">Save to
                        Excel</button>
                </div>
            @endif
        </div>
    </div>
@endsection
