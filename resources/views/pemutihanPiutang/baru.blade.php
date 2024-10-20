@extends('layouts.app')
@section('content')
    <div class="p-4 bg-white rounded-lg shadow-md mt-5 ml-9">
        <!-- Header Section -->
        <div class="border-b border-gray-200 pb-4">
            <h1 class="text-lg font-bold text-center">PEMUTIHAN PIUTANG: BARU</h1>
        </div>

        <!-- Form Section -->
        <div class="mt-4 space-y-4">
            <!-- Nama Pelanggan -->
            <div class="flex items-center">
                <label class="w-1/4 text-sm font-medium text-gray-700">Nama Pelanggan</label>
                <input type="text" class="w-3/4 p-2 border border-gray-300 rounded-md"
                    placeholder="Masukkan Nama Pelanggan">
            </div>

            <!-- No Invoice -->
            <div class="flex items-center">
                <label class="w-1/4 text-sm font-medium text-gray-700">No Invoice</label>
                <input type="text" class="w-3/4 p-2 border border-gray-300 rounded-md" placeholder="Masukkan No Invoice">
            </div>

            <!-- Tanggal Invoice -->
            <div class="flex items-center">
                <label class="w-1/4 text-sm font-medium text-gray-700">Tanggal Invoice</label>
                <input type="date" class="w-3/4 p-2 border border-gray-300 rounded-md">
            </div>

            <!-- Nominal Invoice -->
            <div class="flex items-center">
                <label class="w-1/4 text-sm font-medium text-gray-700">Nominal Invoice</label>
                <input type="text" class="w-3/4 p-2 border border-gray-300 rounded-md"
                    placeholder="Masukkan Nominal Invoice">
            </div>

            <!-- Nominal Pemutihan -->
            <div class="flex items-center">
                <label class="w-1/4 text-sm font-medium text-gray-700">Nominal Pemutihan</label>
                <input type="text" class="w-3/4 p-2 border border-gray-300 rounded-md"
                    placeholder="Masukkan Nominal Pemutihan">
            </div>

            <!-- Sisa Piutang -->
            <div class="flex items-center">
                <label class="w-1/4 text-sm font-medium text-gray-700">Sisa Piutang</label>
                <input type="text" class="w-3/4 p-2 border border-gray-300 rounded-md" placeholder="0" readonly>
            </div>

            <!-- Alasan Pemutihan -->
            <div class="flex items-center">
                <label class="w-1/4 text-sm font-medium text-gray-700">Alasan Pemutihan</label>
                <input type="text" class="w-3/4 p-2 border border-gray-300 rounded-md"
                    placeholder="Masukkan Alasan Pemutihan">
            </div>

            <!-- Dokumen Pendukung -->
            <div class="flex items-center">
                <label class="w-1/4 text-sm font-medium text-gray-700">Dokumen Pendukung</label>
                <input type="file" class="w-3/4 p-2 border border-gray-300 rounded-md">
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="mt-6 flex justify-end space-x-2">
            <button class="px-4 py-2 bg-green-500 text-white font-semibold rounded-md hover:bg-green-600">Simpan</button>
            <button class="px-4 py-2 bg-gray-300 text-gray-700 font-semibold rounded-md hover:bg-gray-400">Batal</button>
        </div>
    </div>
@endsection
