<!-- resources/views/dashboard.blade.php -->

@extends('layouts.app2')

@section('content')
    <div class="flex flex-col md:flex-row justify-center md:justify-evenly items-center bg-gray-300 md:shadow lg:shadow rounded-lg max-w-full md:h-full gap-6 p-4">
        <!-- Bagian Kiri: Informasi Perusahaan dan Pengguna -->
        <div class="text-center flex items-center justify-center flex-col gap-2 w-full md:w-auto">
            <h1 class="text-lg md:text-xl lg:text-2xl font-bold">PT SINAR GALESONG PRATAMA</h1>
            <h2 class="text-md md:text-lg lg:text-xl font-bold text-lg">Departemen <i>Accounting</i></h2>
            <div class="w-24 h-24 md:h-[163px] md:w-[153px] lg:h-[213px] lg:w-[203px] overflow-hidden flex items-center justify-center rounded-md">
                <img src="assets/logo/galesong.png" class="w-full h-full object-contain" alt="Foto Profile">
            </div>
            <h2 class="text-lg font-bold lg:text-xl">Hai <i>Username!</i></h2>
        </div>

        <!-- Bagian Kanan: Tanggal dan Tabel Umur Piutang -->
        <div class="text-right w-full md:w-auto">
            <!-- Tanggal -->
            <p class="text-gray-600 font-normal">{{ $currentDate }}</p>

            <!-- Tabel Umur Piutang -->
            <div class="overflow-x-auto w-full md:w-auto">
                <h2 class="text-lg font-bold mb-2">Umur Piutang</h2>
                <table class="w-full bg-gray-500 border border-gray-200 px-4 py-2 rounded-md ">
                    <thead>
                        <tr>
                            <th class="border border-gray-200 px-4 py-2 md:px-4 md:py-2 text-white text-left">No</th>
                            <th class="border border-gray-200 px-4 py-2 md:px-4 md:py-2 text-white text-left">Aging</th>
                            <th class="border border-gray-200 px-4 py-2 md:px-4 md:py-2 text-white text-left">Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($summaryData as $row)
                            <tr class="font-medium ">
                                <td class="border border-gray-200 px-4 py-2 md:px-4 md:py-2 text-black font-normal text-left">{{ $row['no'] }}</td>
                                <td class="border border-gray-200 px-4 py-2 md:px-4 md:py-2 text-black font-normal text-left">{{ $row['aging'] }}</td>
                                <td class="border border-gray-200 px-4 py-2 md:px-4 md:py-2 text-black font-normal text-left">
                                    {{ 'Rp' . number_format($row['total'], 0, ',', '.') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <button class="w-full md:w-auto active:scale-[.95] hover:bg-white  transition-all text-white border-2 bg-red-700 hover:text-red-700 border-red-700 font-bold py-1 px-4 rounded-md shadow-sm mt-4">
                    Konfirmasi
                </button>
            </div>
        </div>
    </div>
@endsection