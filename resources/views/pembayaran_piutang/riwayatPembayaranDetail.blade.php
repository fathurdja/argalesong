@extends('layouts.app')
@section('content')
    <div class="bg-white shadow-md rounded-lg overflow-hidden lg:mt-20 mt-10 ">

        <div class="p-6 ">
            <h1 class="text-2xl font-bold mb-6 ">Halaman Riwayat Pembayaran Piutang</h1>

            <div class="mb-6">
                <label class="block text-sm font-medium text-gray-700 mb-1">ID Pembayaran</label>
                <div class="w-full border-gray-300 font-bold  rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm text-lg  p-2 bg-gray-100">
                    {{ $detail->IDPembayaran }}
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Nama Pelanggan</label>
                    <div class="w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm text-lg  p-2 bg-gray-100">
                        {{ $detail->NamaPelanggan }}
                    </div>
                </div>
                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Mode Pembayaran</label>
                    <div class="w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm text-lg  p-2 bg-gray-100">
                        {{ $detail->ModePembayaran }}
                    </div>
                </div>
            </div>

            <!-- Fields for Total Piutang and Payment -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Total Semua Piutang</label>
                    <div class="w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm text-lg  p-2 bg-gray-100">
                        Rp{{ number_format($detail->TotalSemuaPiutang, 0, ',', '.') }}
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Nominal yang Dibayar</label>
                    <div class="w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm text-lg  p-2 bg-gray-100">
						{{ number_format($detail->NominalyangDibayar, 0, ',', '.') }}
                    </div>
                </div>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-1 gap-4 mb-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Sisa</label>
                    <div class="w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm text-lg  p-2 bg-gray-100">
                        Rp{{ number_format($detail->Sisa, 0, ',', '.') }}
                    </div>
                </div>
            </div>


            <div class="flex justify-end space-x-2">
                <button type="button" onclick=""
                    class="active:scale-[.95] hover:bg-white hover:text-[#0F8114] transition-all text-white font-medium border-2 border-[#0F8114] rounded-md shadow-sm px-4 py-1 bg-[#810f0f]">Kembali</button>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    @vite('resources/js/test.js')
@endpush
