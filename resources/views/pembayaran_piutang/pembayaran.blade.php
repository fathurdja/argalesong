@extends('layouts.app')

@section('content')
    <div class="container mx-auto mt-5">


        @if ($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                <strong class="font-bold">Error!</strong>
                <span class="block sm:inline">{{ $errors->first() }}</span>
            </div>
        @endif

        <!-- Form untuk Input Nomor Invoice -->
        <div class="bg-white p-16 rounded-lg shadow-md ">

            <form method="GET"
                action="{{ isset($pelanggan) ? route('pembayaran-piutang.index') : route('pembayaran-piutang.index') }}">
                @csrf
                <div class="text-center mb-2">
                    <h1 class="text-2xl font-bold">PEMBAYARAN PIUTANG</h1>
                </div>

            <div class="">
                <!-- tgl transaksi-->
                <div class="mb-4">
                    <label for="tanggal_transaksi" class="block text-sm font-medium text-gray-700">Tanggal
                        Transaksi</label>
                    <input type="date" name="tanggal_transaksi" id="tanggal_transaksi"
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                </div>

                <!-- nomor invoice form -->
                <div id="invoice-form">
                    <div class="flex space-x-2 mb-1">
                        <button onclick="tambahBaris()" class="bg-blue-500 text-white text-sm px-2 py-1 rounded-full">+</button>
                        <input type="text" name="nomor_invoice[]"  class="border border-gray-300 rounded px-2 py-1 text-sm" placeholder="Nomor Invoice">
                        <input type="text" name="nama_pelanggan[]" placeholder="Nama Pelanggan" class="border border-gray-300 rounded px-2 py-1 text-sm">
                        <input type="date" name="jatuh_tempo[]" placeholder="Jatuh Tempo" class="border border-gray-300 rounded px-2 py-1 text-sm">
                        <input type="number" name="piutang_belum_dibayar[]" placeholder="Piutang Belum Dibayar" class="border border-gray-300 rounded px-2 py-1 text-sm">
                        <input type="number" name="denda[]" placeholder="Denda" class="border border-gray-300 rounded px-2 py-1 text-sm">
                        <input type="number" name="diskon[]" placeholder="Diskon" class="border border-gray-300 rounded px-2 py-1 text-sm">
                    </div>
                </div>

            </div>
                <!-- Invoice Form -->
            <div class="flex flex-col mb-5">
            <label for="nomor_invoice" class="block text-sm font-medium text-gray-700">Total Semua Piutang</label>
                <input 
                    type="number" 
                    class="border border-gray-300 p-2 rounded-lg" 
                    placeholder="Total Piutang" 
                    v-model="invoiceData.paymentAmount"
                />
            </div>

            <div class="flex flex-col">
            <label for="nomor_invoice" class="block text-sm font-medium text-gray-700">Nominal yang di bayar</label>
                <input 
                    type="number" 
                    class="border border-gray-300 p-2 rounded-lg" 
                    placeholder="Nominal yang Dibayar" 
                    v-model="invoiceData.paymentAmount"
                />
            </div>
        </div>


                <!-- Nama Pelanggan, Tipe Pelanggan, Tipe Piutang, dll. (Auto-fill dari server) -->
                @if (isset($pelanggan))
                    <div class="space-y-2">
                        <div class="text-center mb-2">
                            <h1 class="text-2xl font-bold">PEMBAYARAN PIUTANG</h1>
                        </div>
                        
                        <!-- Nama Pelanggan -->
                        <div class="flex justify-start items-center">
                            <span class="font-semibold w-40">Nama Pelanggan:</span>
                            <span>{{ $pelanggan->name }}</span>
                        </div>

                        <!-- Tipe Pelanggan -->
                        <div class="flex justify-start items-center">
                            <span class="font-semibold w-40">Tipe Pelanggan:</span>
                            <span>{{ $tipePelanggan->name }}</span>
                        </div>

                        <!-- Tipe Piutang -->
                        <div class="flex justify-start items-center">
                            <span class="font-semibold w-40">Tipe Piutang:</span>
                            <span>{{ $jenisPiutang->name }}</span>
                        </div>

                        <!-- Kas / Bank -->
                        <div class="flex justify-start items-center">
                            <label for="modebayar" class="block  font-semibold  w-40">Mode Bayar</label>
                            <select id="modebayar" name="modebayar"
                                class="mt-1 block w-52 p-2 border-gray-300 rounded-md shadow-sm">
                                <option value="KAS" {{ old('modebayar') == 'KAS' ? 'selected' : '' }}>KAS</option>
                                <option value="BANK" {{ old('modebayar') == 'BANK' ? 'selected' : '' }}>BANK</option>
                            </select>
                        </div>

                        <!-- Diskon -->
                        <div class="flex justify-start items-center">
                            <label for="diskon" class="font-semibold  w-40 ">Diskon:</label>
                            <input type="text" id="diskon" name="diskon"
                                class="p-1 border-gray-300 rounded-md shadow-sm w-20" placeholder="Diskon %"
                                value="{{ old('diskon') }}">
                            <span class="ml-3">Rp. {{ $pelanggan->diskon }}</span>
                        </div>
                        <div class="flex justify-start items-center font-bold">
                            <span class="w-40">Total Bayar:</span>
                            <input type="text" id="totalbayar" name="totalbayar" placeholder="Rp. 00" class="rounded-md">
                        </div>
                        <!-- Total Piutang -->
                        <div class="flex justify-start items-center font-bold">
                            <span class="w-40">Total Piutang:</span>
                            <span>Rp. {{ $detailPiutang->nominal }}</span>
                        </div>
                    </div>

                    <!-- Keterangan (multi-line input) -->
                    <div class="mb-4 mt-4">
                        <label for="keterangan" class="block text-sm font-medium text-gray-700">Keterangan</label>
                        <textarea id="keterangan" name="keterangan" class="mt-1 p-2 block w-full border-gray-300 rounded-md shadow-sm"
                            rows="4" placeholder="Masukkan keterangan">{{ old('keterangan') }}</textarea>
                    </div>
                @else
                    <p class="text-gray-500 italic">Masukkan nomor invoice untuk melihat informasi pembayaran piutang.</p>
                @endif

                <!-- Submit Button -->
                <div class="mt-6 px-4">
                    @if (isset($pelanggan))
                        <button type="submit" class="w-24 bg-blue-500 text-white p-2 rounded-md">Bayar</button>
                    @else
                        <button type="submit" class="w-24 bg-green-500 text-white p-2 rounded-md">Cari</button>
                    @endif
                    <button class="w-24 bg-gray-500 text-white p-2 rounded-md" type="reset">Batal</button>
                </div>
            </form>
        </div>
    </div>
@endsection
