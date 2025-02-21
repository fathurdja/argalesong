@extends('layouts.app')
@section('content')
    <div class="p-6 bg-white rounded-lg shadow-md mt-10 lg:ml-10 lg:mt-20">
        <div class="border-b border-gray-200 pb-4">
            <h1 class="text-2xl font-bold mb-4">PEMUTIHAN PIUTANG: PENGAJUAN</h1>
        </div>

        <div class="mt-4">
            <label class="text-gray-700 font-semibold">Jumlah Pemutihan Piutang</label>
            <div class="text-2xl font-bold text-black">
                Rp<span>123,456,786</span>
            </div>
        </div>

        <div class="lg:flex justify-start items-center mt-4 space-y-4 lg:space-x-4">
            <div class="lg:flex items-center">
                <label for="tahun" class="mr-2 text-sm font-medium text-gray-700">Tahun</label>
                <select id="tahun" name="tahun" class="block w-full pl-3 pr-10 py-2 border-gray-300 rounded-md">
                    <option>2023</option>
                    <option>2024</option>
                </select>
            </div>

            <div class="lg:flex items-center">
                <label for="bulan" class="mr-2 text-sm font-medium text-gray-700">Bulan</label>
                <select id="bulan" name="bulan" class="block w-full pl-3 pr-10 py-2 border-gray-300 rounded-md">
                    <option>Juli</option>
                    <option>Agustus</option>
                </select>
            </div>

            <div class="lg:flex items-center">
                <label for="status" class="mr-2 text-sm font-medium text-gray-700">Status</label>
                <select id="status" name="status" class="block w-full pl-3 pr-10 py-2 border-gray-300 rounded-md">
                    <option>Release</option>
                    <option>Pending</option>
                </select>
            </div>
        </div>

        <div class="mt-6">
            <h2 class="text-lg font-semibold mb-4">Juli</h2>
            <div class="overflow-auto">
                <!-- Desktop Table -->
                <table class="w-full border-collapse border border-gray-300 hidden md:table">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="border px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">No</th>
                            <th class="border px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Tgl Pengajuan Pemutihan</th>
                            <th class="border px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Nama Pelanggan</th>
                            <th class="border px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">No Invoice</th>
                            <th class="border px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Tgl Invoice</th>
                            <th class="border px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Nominal Pemutihan</th>
                            <th class="border px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Alasan Pemutihan</th>
                            <th class="border px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Dokumen Pendukung</th>
                            <th class="border px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Status Pengajuan</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white">
                        <tr>
                            <td class="border px-4 py-2">1</td>
                            <td class="border px-4 py-2">01/07/2024</td>
                            <td class="border px-4 py-2">PT XXX</td>
                            <td class="border px-4 py-2">INV0024</td>
                            <td class="border px-4 py-2">23/07/2022</td>
                            <td class="border px-4 py-2">Rp12,000,000</td>
                            <td class="border px-4 py-2">.....</td>
                            <td class="border px-4 py-2">memo</td>
                            <td class="border px-4 py-2">Release</td>
                        </tr>
                    </tbody>
                </table>
                
                <!-- Mobile Table -->
                <div class="md:hidden">
                    <div class="space-y-4">
                        <div class="border-b border-gray-300 pb-4">
                            <div class="text-sm text-gray-700">No</div>
                            <div class="text-sm font-semibold text-gray-900">1</div>
                        </div>
                        <div class="border-b border-gray-300 pb-4">
                            <div class="text-sm text-gray-700">Nama Pelanggan</div>
                            <div class="text-sm font-semibold text-gray-900">PT XXX</div>
                        </div>
                        <div class="border-b border-gray-300 pb-4">
                            <div class="text-sm text-gray-700">Nominal Pemutihan</div>
                            <div class="text-sm font-semibold text-gray-900">Rp12,000,000</div>
                        </div>
                        <div class="border-b border-gray-300 pb-4">
                            <div class="text-sm text-gray-700">Status Pengajuan</div>
                            <div class="text-sm font-semibold text-gray-900">Release</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
