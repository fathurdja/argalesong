@extends('layouts.app')
@section('content')
    <div class="sm:p-6 bg-white rounded-lg shadow-md mt-6 w-full">
        <div class="flex justify-start mb-4 w-full flex-col sm:flex-row gap-2 sm:gap-10 px-2 py-1 sm:p-4">
            <div class="flex items-center">
                <label for="tahun" class="mr-2 text-sm font-medium text-gray-700">Tahun</label>
                <select id="tahun" name="tahun"
                    class="block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md">
                    <!-- Options for year -->
                    <option>2023</option>
                    <option>2024</option>
                    <!-- Add more years as needed -->
                </select>
            </div>
            <div class="flex items-center">
                <label for="bulan" class="mr-2 text-sm font-medium text-gray-700">Bulan</label>
                <select id="bulan" name="bulan"
                    class="block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md">
                    <!-- Options for months -->
                    <option>Januari</option>
                    <option>Februari</option>
                    <option>Maret</option>
                    <!-- Add more months as needed -->
                </select>
            </div>
        </div>

        <div class="min-w-full overflow-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No</th>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No Invoice
                        </th>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kode
                            Perusahaan</th>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama
                            Pelanggan</th>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tgl Invoice
                        </th>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tgl Jatuh
                            Tempo</th>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Piutang Belum
                            Dibayar</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">1</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">INV024255</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">PRS348</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">PT Fast Food Indonesia</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">03/02/2023</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">02/03/2023</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">23,000,000</td>
                    </tr>
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">2</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">INV024256</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">PRS500</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">PT Tiga Dua Delapan</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">15/02/2023</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">14/03/2023</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">50,000,000</td>
                    </tr>
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="6" class="px-6 py-4 text-right font-bold text-gray-700">Total</td>
                        <td class="px-6 py-4 font-bold text-gray-700">73,000,000</td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
@endsection
