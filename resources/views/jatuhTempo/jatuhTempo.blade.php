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
            <table class="min-w-full divide-y divide-gray-200 text-[10px] sm:text-xs md:text-md lg:text-lg">
                <thead class="bg-gray-50">
                    <tr>
                        <th scope="col"
                            class="px-2 py-1  sm:px-6 sm:py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No</th>
                        <th scope="col"
                            class="px-2 py-1  sm:px-6 sm:py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No
                            Invoice
                        </th>
                        <th scope="col"
                            class="px-2 py-1  sm:px-6 sm:py-3 text-left text-xs font-medium text-gray-500 hidden sm:table-cell uppercase tracking-wider">
                            Kode
                            Perusahaan</th>
                        <th scope="col"
                            class="px-2 py-1  sm:px-6 sm:py-3 text-left text-xs font-medium text-gray-500 hidden sm:table-cell uppercase tracking-wider">
                            Nama
                            Pelanggan</th>
                        <th scope="col"
                            class="px-2 py-1  sm:px-6 sm:py-3 text-left text-xs font-medium text-gray-500 hidden sm:table-cell uppercase tracking-wider">
                            Tgl Invoice
                        </th>
                        <th scope="col"
                            class="px-2 py-1  sm:px-6 sm:py-3 text-left text-xs font-medium text-gray-500 hidden sm:table-cell uppercase tracking-wider">
                            Tgl Jatuh
                            Tempo</th>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Piutang
                            Belum
                            Dibayar</th>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 table-cell sm:hidden uppercase tracking-wider">
                            Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">1</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">INV024255</td>
                        <td class="px-1 py-2 sm:px-6 sm:py-4 whitespace-nowrap text-sm hidden sm:table-cell text-gray-500">PRS348</td>
                        <td class="px-1 py-2 sm:px-6 sm:py-4 whitespace-nowrap text-sm hidden sm:table-cell text-gray-500">PT Fast Food Indonesia</td>
                        <td class="px-1 py-2 sm:px-6 sm:py-4 whitespace-nowrap text-sm hidden sm:table-cell text-gray-500">03/02/2023</td>
                        <td class="px-1 py-2 sm:px-6 sm:py-4 whitespace-nowrap text-sm hidden sm:table-cell text-gray-500">02/03/2023</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">23,000,000</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm table-cell sm:hidden text-gray-500">
                            <div class="w-3 mx-auto">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48">
                                    <path fill="#2196f3" d="M17.1 5L14 8.1L29.9 24L14 39.9l3.1 3.1L36 24z" />
                                </svg>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">1</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">INV024255</td>
                        <td class="px-1 py-2 sm:px-6 sm:py-4 whitespace-nowrap text-sm hidden sm:table-cell text-gray-500">PRS348</td>
                        <td class="px-1 py-2 sm:px-6 sm:py-4 whitespace-nowrap text-sm hidden sm:table-cell text-gray-500">PT Fast Food Indonesia</td>
                        <td class="px-1 py-2 sm:px-6 sm:py-4 whitespace-nowrap text-sm hidden sm:table-cell text-gray-500">03/02/2023</td>
                        <td class="px-1 py-2 sm:px-6 sm:py-4 whitespace-nowrap text-sm hidden sm:table-cell text-gray-500">02/03/2023</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">23,000,000</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm table-cell sm:hidden text-gray-500">
                            <div class="w-3 mx-auto">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48">
                                    <path fill="#2196f3" d="M17.1 5L14 8.1L29.9 24L14 39.9l3.1 3.1L36 24z" />
                                </svg>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">1</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">INV024255</td>
                        <td class="px-1 py-2 sm:px-6 sm:py-4 whitespace-nowrap text-sm hidden sm:table-cell text-gray-500">PRS348</td>
                        <td class="px-1 py-2 sm:px-6 sm:py-4 whitespace-nowrap text-sm hidden sm:table-cell text-gray-500">PT Fast Food Indonesia</td>
                        <td class="px-1 py-2 sm:px-6 sm:py-4 whitespace-nowrap text-sm hidden sm:table-cell text-gray-500">03/02/2023</td>
                        <td class="px-1 py-2 sm:px-6 sm:py-4 whitespace-nowrap text-sm hidden sm:table-cell text-gray-500">02/03/2023</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">23,000,000</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm table-cell sm:hidden text-gray-500">
                            <div class="w-3 mx-auto">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48">
                                    <path fill="#2196f3" d="M17.1 5L14 8.1L29.9 24L14 39.9l3.1 3.1L36 24z" />
                                </svg>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">1</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">INV024255</td>
                        <td class="px-1 py-2 sm:px-6 sm:py-4 whitespace-nowrap text-sm hidden sm:table-cell text-gray-500">PRS348</td>
                        <td class="px-1 py-2 sm:px-6 sm:py-4 whitespace-nowrap text-sm hidden sm:table-cell text-gray-500">PT Fast Food Indonesia</td>
                        <td class="px-1 py-2 sm:px-6 sm:py-4 whitespace-nowrap text-sm hidden sm:table-cell text-gray-500">03/02/2023</td>
                        <td class="px-1 py-2 sm:px-6 sm:py-4 whitespace-nowrap text-sm hidden sm:table-cell text-gray-500">02/03/2023</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">23,000,000</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm table-cell sm:hidden text-gray-500">
                            <div class="w-3 mx-auto">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48">
                                    <path fill="#2196f3" d="M17.1 5L14 8.1L29.9 24L14 39.9l3.1 3.1L36 24z" />
                                </svg>
                            </div>
                        </td>
                    </tr>

                </tbody>
                <tfoot>
                    <tr class="hidden sm:table-row">
                        <td colspan="6" class="px-6 py-4 text-right sm:text-lg lg:text-lg font-bold text-gray-700">Total</td>
                        <td class="px-6 py-4 font-bold text-gray-700 text-lg">73,000,000</td>
                    </tr>
                    <tr class="table-row sm:hidden">
                        <td colspan="3" class="px-2 text-md py-1 text-right font-bold text-gray-700">Total</td>
                        <td class="px-2 py-1 font-bold text-gray-700">73,000,000</td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
@endsection
