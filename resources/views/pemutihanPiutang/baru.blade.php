@extends('layouts.app')
@section('content')
    <div class="p-4 bg-white rounded-lg lg:shadow-md mt-14 lg:mt-20 lg:p-10">
        <!-- Header Section -->
        <div class="border-b border-gray-200 pb-4">
            <h1 class="text-2xl font-bold mb-4">PEMUTIHAN PIUTANG: BARU</h1>
        </div>

        <!-- Form Section -->
        <div class="mt-4 space-y-4">
            <!-- Nama Pelanggan -->
            <div class="lg:flex items-center">
                <label class="w-1/4 text-sm font-medium text-gray-700">Nama Pelanggan</label>
                <input type="text" class="w-80 p-2 border border-gray-300 rounded-md"
                    placeholder="Masukkan Nama Pelanggan">
            </div>

            <!-- No Invoice -->
            <div class="lg:flex items-center">
                <label class="w-1/4 text-sm font-medium text-gray-700">Nomor Invoice</label>
                <input type="text" class=" w-80 p-2 border border-gray-300 rounded-md" 
                    placeholder="Masukkan No Invoice">
            </div>

            <!-- Tanggal Invoice -->
            <div class="lg:flex items-center">
                <label class="w-1/4 text-sm font-medium text-gray-700">Tanggal Invoice</label>
                <input type="date" class="w-80 p-2 border border-gray-300 rounded-md">
            </div>

            <!-- Nominal Invoice -->
            <div class="lg:flex items-center">
                <label class="w-1/4 text-sm font-medium text-gray-700">Nominal Invoice</label>
                <input type="text" class="w-80 p-2 border border-gray-300 rounded-md"
                    placeholder="Masukkan Nominal Invoice">
            </div>

            <!-- Nominal Pemutihan -->
            <div class="lg:flex items-center">
                <label class="w-1/4 text-sm font-medium text-gray-700">Nominal Pemutihan</label>
                <input type="text" class="w-80 p-2 border border-gray-300 rounded-md"
                    placeholder="Masukkan Nominal Pemutihan">
            </div>

            <!-- Sisa Piutang -->
            <div class="lg:flex items-center">
                <label class="w-1/4 text-sm font-medium text-gray-700">Sisa Piutang</label>
                <input type="text" class="w-80 p-2 border border-gray-300 rounded-md" placeholder="0" readonly>
            </div>

            <!-- Alasan Pemutihan -->
            <div class="lg:flex items-center">
                <label class="w-1/4 text-sm font-medium text-gray-700">Alasan Pemutihan</label>
                <input type="text" class="w-80 p-2 border border-gray-300 rounded-md"
                    placeholder="Masukkan Alasan Pemutihan">
            </div>

            <!-- Dokumen Pendukung -->
            <div class="lg:flex items-center">
                <label class="w-1/4 text-sm font-medium text-gray-700">Dokumen Pendukung</label>
                <input type="file" class="w-80 p-2 border border-gray-300 rounded-md">
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="mt-6 flex justify-center space-x-2">
            <button class="active:scale-[.95] hover:bg-white hover:text-[#0F8114] transition-all text-white font-medium border-2 border-[#0F8114] rounded-md shadow-sm px-4 py-1 bg-[#0F8114]">Simpan</button>
            <button class="active:scale-[.95] hover:bg-white hover:text-[#] transition-all text-white border-2 bg-red-700 hover:text-red-700 border-red-700 py-1 px-4 rounded-md shadow-sm font-medium">Batal</button>
        </div>
    </div>
@endsection