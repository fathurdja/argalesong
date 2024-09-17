<!-- resources/views/pembayaran-piutang.blade.php -->
@extends('layouts.app')

@section('content')
    <div class="container mx-auto mt-10">
        <div class="text-center mb-8">
            <h1 class="text-2xl font-bold">PEMBAYARAN PIUTANG</h1>
        </div>

        <!-- Form untuk Input Nomor Invoice -->
        <div class="bg-white p-6 rounded-lg shadow-md">
            <form method="POST" action="">
                @csrf
                <!-- Nomor Invoice -->
                <div class="mb-4">
                    <label for="nomor_invoice" class="block text-sm font-medium text-gray-700">Nomor Invoice</label>
                    <input type="text" id="nomor_invoice" name="nomor_invoice"
                        class="mt-1 p-2 block w-full border-gray-300 rounded-md shadow-sm"
                        placeholder="Masukkan Nomor Invoice" value="">
                </div>

                <!-- Nama Pelanggan, Tipe Pelanggan, Tipe Piutang, dll. (Auto-fill dari server) -->
                {{-- @if (isset($data)) --}}
                <div class="space-y-4">
                    <!-- Nama Pelanggan -->
                    <div class="flex justify-between">
                        <span class="font-semibold">Nama Pelanggan:</span>

                    </div>

                    <!-- Tipe Pelanggan -->
                    <div class="flex justify-between">
                        <span class="font-semibold">Tipe Pelanggan:</span>

                    </div>

                    <!-- Tipe Piutang -->
                    <div class="flex justify-between">
                        <span class="font-semibold">Tipe Piutang:</span>
                        </span>
                    </div>

                    <!-- Kas / Bank -->
                    <div class="flex justify-between">
                        <span class="font-semibold">Kas / Bank:</span>
                        <span></span>
                    </div>

                    <!-- Diskon -->
                    <div class="flex-row justify-start ">
                        <label for="nomor_invoice" class="block  font-medium text-lg text-gray-700 mt-1"> Diskon
                            :</label>
                        <div class="flex">
                            <input type="text" id="nomor_invoice" name="nomor_invoice"
                                class="mt-1 ml-1 p-1 block w-32 border-gray-300 rounded-md shadow-sm" placeholder="Diskon %"
                                value="">
                            <span class="text-lg ml-3">Rp. </span>
                        </div>

                    </div>

                    <!-- Total Piutang -->
                    <div class="flex justify-between font-bold">
                        <span>Total Piutang:</span>
                        <span></span>
                    </div>
                </div>
                {{-- @else --}}
                <p class="text-gray-500 italic">Masukkan nomor invoice untuk melihat informasi pembayaran piutang.</p>
                {{-- @endif --}}

                <!-- Submit Button -->
                <div class="mt-6 px-4">
                    <button type="submit" class="w-24 bg-green-500 text-white p-2 rounded-md">Bayar</button>
                    <button class="w-24 bg-gray-500 text-white p-2 rounded-md" type="reset">Batal</button>
                </div>
            </form>
        </div>
    </div>
@endsection
