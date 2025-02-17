@extends('layouts.app')
@section('content')
    <div class="p-6 bg-white rounded-lg shadow-md mt-5 lg:ml-10">
        <div class="border-b border-gray-200 pb-4">
            <h1 class="text-2xl font-bold mb-4">PEMUTIHAN PIUTANG: PENGAJUAN</h1>
            <h1 class="text-2xl font-bold mb-4">PEMUTIHAN PIUTANG: PENGAJUAN</h1>
        </div>

        <div class="mt-4">
            <label class="text-gray-700 font-semibold">Jumlah Pemutihan Piutang</label>
            <div class="text-2xl font-bold text-black">
                Rp<span>123,456,786</span>
            </div>
        </div>

        <div class="flex justify-start items-center mt-4 space-x-4">
            <div class="flex items-center">
                <label for="tahun" class="mr-2 text-sm font-medium text-gray-700">Tahun</label>
                <select id="tahun" name="tahun" class="block w-full pl-3 pr-10 py-2 border-gray-300 rounded-md">
                    <option>2023</option>
                    <option>2024</option>
                </select>
            </div>

            <div class="flex items-center">
                <label for="bulan" class="mr-2 text-sm font-medium text-gray-700">Bulan</label>
                <select id="bulan" name="bulan" class="block w-full pl-3 pr-10 py-2 border-gray-300 rounded-md">
                    <option>Juli</option>
                    <option>Agustus</option>
                </select>
            </div>

            <div class="flex items-center">
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
                
                <table class="w-full border-collapse border border-gray-300 md:hidden">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="border px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">No</th>
                            <th class="border px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Nama Pelanggan</th>
                            <th class="border px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Nominal Pemutihan</th>
                            <th class="border px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white">
                        <tr>
                            <td class="border px-4 py-2">1</td>
                            <td class="border px-4 py-2">PT XXX</td>
                            <td class="border px-4 py-2">Rp12,000,000</td>
                            <td class="border px-4 py-2 text-center">
                                <a href="#" class="inline-block p-2 border rounded-md hover:bg-gray-100">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><rect width="24" height="24" fill="none"/>
                                        <path fill="#374151" d="M21 12a1 1 0 0 0-1 1v6a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1V5a1 1 0 0 1 1-1h6a1 1 0 0 0 0-2H5a3 3 0 0 0-3 3v14a3 3 0 0 0 3 3h14a3 3 0 0 0 3-3v-6a1 1 0 0 0-1-1m-15 .76V17a1 1 0 0 0 1 1h4.24a1 1 0 0 0 .71-.29l6.92-6.93L21.71 8a1 1 0 0 0 0-1.42l-4.24-4.29a1 1 0 0 0-1.42 0l-2.82 2.83l-6.94 6.93a1 1 0 0 0-.29.71m10.76-8.35l2.83 2.83l-1.42 1.42l-2.83-2.83ZM8 13.17l5.93-5.93l2.83 2.83L10.83 16H8Z"/>
                                    </svg>
                                </a>
                            </td>                            
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
