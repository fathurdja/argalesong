@extends('layouts.app')

@section('content')
    <div class="bg-white shadow-md rounded-lg overflow-hidden lg:mt-20 mt-10">

        <div class="p-6">
            <h1 class="text-2xl font-bold mb-6">Halaman Detail Bulanan</h1>

            <div class="mb-6">
                <label class="block text-sm font-medium text-gray-700 mb-1">ID Pengajuan Piutang</label>
                <div class="w-full border-gray-300 font-bold rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm text-lg p-2 bg-gray-100">
                    {{ $data->no_invoice }}
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Nama Pelanggan</label>
                    <div class="w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm text-lg p-2 bg-gray-100">
                        {{ $data->customer_name }}
                    </div>
                </div>
                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Tanggal Transaksi</label>
                    <div class="w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm text-lg p-2 bg-gray-100">
                        {{ $data->tgltra }}
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Total Piutang</label>
                    <div class="w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm text-lg p-2 bg-gray-100">
                        Rp{{ number_format($data->nominal, 2, ',', '.') }}
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">DPP</label>
                    <div class="w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm text-lg p-2 bg-gray-100">
                        Rp{{ number_format($data->jumlahTagihan, 2, ',', '.') }}
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">PPN</label>
                    <div class="w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm text-lg p-2 bg-gray-100">
                        Rp{{ number_format($data->ppn, 2, ',', '.') }}
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Pajak</label>
                    <div class="w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm text-lg p-2 bg-gray-100">
                        Rp{{ number_format($data->pajak, 2, ',', '.') }}
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-1 gap-4 mb-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Status Pengajuan</label>
                    <div class="w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm text-lg p-2 bg-gray-100">
                        @if ($data->statusPembayaran == 'LUNAS') 
                            <span class="bg-green-500 text-white px-2 py-1 rounded">Lunas</span>
                        @elseif($data->statusPembayaran == 'SEBAGIAN') 
                            <span class="bg-yellow-500 text-white px-2 py-1 rounded">Sebagian</span>
                        @else 
                            <span class="bg-red-500 text-white px-2 py-1 rounded">Belum Lunas</span>
                        @endif
                    </div>
                </div>
            </div>

            <div class="flex justify-end space-x-2">
                <button type="button" onclick="window.location.href='{{ route('sp-bulanan') }}'"
                    class="active:scale-[.95] flex flex-row items-center group justify-center gap-1 py-1 hover:bg-white hover:text-[#161616] transition-all text-white font-medium border-2 border-[#161616] rounded-md shadow-sm px-4 bg-[#161616]">
                    <div class="">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20">
                            <path fill="white" class="group-hover:fill-[#161616] transition-colors" d="m4 10l9 9l1.4-1.5L7 10l7.4-7.5L13 1z"/>
                        </svg>
                    </div>
                    <span>Kembali</span>
                </button>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    @vite('resources/js/test.js') 
@endpush