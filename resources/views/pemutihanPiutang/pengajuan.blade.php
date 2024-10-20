@extends('layouts.app')
@section('content')
    <div class="p-6 bg-white rounded-lg shadow-md mt-5 ml-9">
        <!-- Header Section -->
        <div class="border-b border-gray-200 pb-4">
            <h1 class="text-lg font-bold text-center">PEMUTIHAN PIUTANG: PENGAJUAN</h1>
        </div>

        <!-- Jumlah Pemutihan Piutang -->
        <div class="mt-4">
            <label class="text-gray-700 font-semibold">Jumlah Pemutihan Piutang</label>
            <div class="text-2xl font-bold text-black">
                Rp<span>123,456,786</span>
            </div>
        </div>

        <!-- Filters Section -->
        <div class="flex justify-start items-center mt-4 space-x-4">
            <!-- Tahun -->
            <div class="flex items-center">
                <label for="tahun" class="mr-2 text-sm font-medium text-gray-700">Tahun</label>
                <select id="tahun" name="tahun"
                    class="block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md">
                    <option>2023</option>
                    <option>2024</option>
                </select>
            </div>

            <!-- Bulan -->
            <div class="flex items-center">
                <label for="bulan" class="mr-2 text-sm font-medium text-gray-700">Bulan</label>
                <select id="bulan" name="bulan"
                    class="block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md">
                    <option>Juli</option>
                    <option>Agustus</option>
                </select>
            </div>

            <!-- Status -->
            <div class="flex items-center">
                <label for="status" class="mr-2 text-sm font-medium text-gray-700">Status</label>
                <select id="status" name="status"
                    class="block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md">
                    <option>Release</option>
                    <option>Pending</option>
                </select>
            </div>
        </div>

        <!-- Table Section -->
        <div class="mt-6">
            <h2 class="text-lg font-semibold mb-4">Juli</h2>
            <table class="min-w-full border-collapse border border-gray-300">
                <thead class="bg-gray-50">
                    <tr>
                        <th scope="col"
                            class="border border-gray-300 px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            No</th>
                        <th scope="col"
                            class="border border-gray-300 px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Tgl Pengajuan Pemutihan</th>
                        <th scope="col"
                            class="border border-gray-300 px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Nama Pelanggan</th>
                        <th scope="col"
                            class="border border-gray-300 px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            No Invoice</th>
                        <th scope="col"
                            class="border border-gray-300 px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Tgl Invoice</th>
                        <th scope="col"
                            class="border border-gray-300 px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Nominal Pemutihan</th>
                        <th scope="col"
                            class="border border-gray-300 px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Alasan Pemutihan</th>
                        <th scope="col"
                            class="border border-gray-300 px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Dokumen Pendukung</th>
                        <th scope="col"
                            class="border border-gray-300 px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Status Pengajuan</th>
                    </tr>
                </thead>
                <tbody class="bg-white">
                    <tr>
                        <td class="border border-gray-300 px-4 py-2 text-sm text-gray-500">1</td>
                        <td class="border border-gray-300 px-4 py-2 text-sm text-gray-500">01/07/2024</td>
                        <td class="border border-gray-300 px-4 py-2 text-sm text-gray-500">PT XXX</td>
                        <td class="border border-gray-300 px-4 py-2 text-sm text-gray-500">INV0024</td>
                        <td class="border border-gray-300 px-4 py-2 text-sm text-gray-500">23/07/2022</td>
                        <td class="border border-gray-300 px-4 py-2 text-sm text-gray-500">Rp12,000,000</td>
                        <td class="border border-gray-300 px-4 py-2 text-sm text-gray-500">.....</td>
                        <td class="border border-gray-300 px-4 py-2 text-sm text-gray-500">memo</td>
                        <td class="border border-gray-300 px-4 py-2 text-sm text-gray-500">Release</td>
                    </tr>
                    <tr>
                        <td class="border border-gray-300 px-4 py-2 text-sm text-gray-500">2</td>
                        <td class="border border-gray-300 px-4 py-2 text-sm text-gray-500">13/07/2024</td>
                        <td class="border border-gray-300 px-4 py-2 text-sm text-gray-500">PT XXX</td>
                        <td class="border border-gray-300 px-4 py-2 text-sm text-gray-500">INV1234</td>
                        <td class="border border-gray-300 px-4 py-2 text-sm text-gray-500">02/07/2022</td>
                        <td class="border border-gray-300 px-4 py-2 text-sm text-gray-500">Rp50,000,000</td>
                        <td class="border border-gray-300 px-4 py-2 text-sm text-gray-500">.....</td>
                        <td class="border border-gray-300 px-4 py-2 text-sm text-gray-500">memo</td>
                        <td class="border border-gray-300 px-4 py-2 text-sm text-gray-500">Release</td>
                    </tr>
                    <tr>
                        <td class="border border-gray-300 px-4 py-2 text-sm text-gray-500">3</td>
                        <td class="border border-gray-300 px-4 py-2 text-sm text-gray-500">20/07/2024</td>
                        <td class="border border-gray-300 px-4 py-2 text-sm text-gray-500">PT XXX</td>
                        <td class="border border-gray-300 px-4 py-2 text-sm text-gray-500">INV0044</td>
                        <td class="border border-gray-300 px-4 py-2 text-sm text-gray-500">01/07/2023</td>
                        <td class="border border-gray-300 px-4 py-2 text-sm text-gray-500">Rp5,000,000</td>
                        <td class="border border-gray-300 px-4 py-2 text-sm text-gray-500">.....</td>
                        <td class="border border-gray-300 px-4 py-2 text-sm text-gray-500">memo</td>
                        <td class="border border-gray-300 px-4 py-2 text-sm text-gray-500">Release</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
@endsection
