<!-- resources/views/dashboard.blade.php -->

@extends('layouts.app2')

@section('content')
    <div class="flex flex-col sm:flex-row justify-center md:justify-evenly items-center bg-gray-300 md:shadow lg:shadow rounded-lg max-w-full md:h-full gap-1 container p-4">
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
            <div class="overflow-x-auto w-full h-full md:w-auto">
                <h2 class="text-lg font-bold mb-2">Umur Piutang</h2>
                <table class="w-full bg-[#D8E2FD] border border-gray-200 px-1 py-1 rounded-md ">
                    <thead>
                        <tr>
                            <th class="border border-gray-200 px-1 py-1 md:px-4 md:py-2 text-[#2E2659] text-center md:text-left">No</th>
                            <th class="border border-gray-200 px-1 py-1 md:px-4 md:py-2 text-[#2E2659] text-center md:text-left">Aging</th>
                            <th class="border border-gray-200 px-1 py-1 md:px-4 md:py-2 text-[#2E2659] text-center md:text-left">Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($summaryData as $row)
                            <tr class="font-medium ">
                                <td class="border border-gray-200 px-1 py-1 md:px-4 md:py-2 text-black font-normal text-center md:text-left">{{ $row['no'] }}</td>
                                <td class="border border-gray-200 px-1 py-1 md:px-4 md:py-2 text-black font-normal text-center md:text-left">{{ $row['aging'] }}</td>
                                <td class="border border-gray-200 px-1 py-1 md:px-4 md:py-2 text-black font-normal text-center md:text-left">
                                    {{ 'Rp' . number_format($row['total'], 0, ',', '.') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="justify-center items-center w-full  mt-5 flex md:hidden ">
                    <ul class="justify-center items-center w-full pl-12 scroll-smooth  py-1 flex md:hidden flex-row gap-5 overflow-scroll scrollbar-hide">
                        <li>
                            <a href="{{ route('customer.index') }}">
                                <div class="w-[50px] flex justify-start items-center flex-col text-center text-xs/4">
                                    <div class="w-full rounded-sm py-1 px-2 bg-[#5F708A] text-white flex justify-center items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="90%" viewBox="0 0 24 24"><path fill="currentColor" fill-rule="evenodd" d="M8 7a4 4 0 1 1 8 0a4 4 0 0 1-8 0m0 6a5 5 0 0 0-5 5a3 3 0 0 0 3 3h12a3 3 0 0 0 3-3a5 5 0 0 0-5-5z" clip-rule="evenodd"/></svg>
                                    </div>
                                    <span >Daftar Pelanggan</span>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('customer.index') }}">
                                <div class="w-[50px] flex justify-start items-center flex-col text-center text-xs/4">
                                    <div class="w-full rounded-sm py-1 px-2 bg-[#5F708A] text-white flex justify-center items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="90%" viewBox="0 0 24 24"><path fill="currentColor" fill-rule="evenodd" d="M8 7a4 4 0 1 1 8 0a4 4 0 0 1-8 0m0 6a5 5 0 0 0-5 5a3 3 0 0 0 3 3h12a3 3 0 0 0 3-3a5 5 0 0 0-5-5z" clip-rule="evenodd"/></svg>
                                    </div>
                                    <span >Daftar Pelanggan</span>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('customer.index') }}">
                                <div class="w-[50px] flex justify-start items-center flex-col text-center text-xs/4">
                                    <div class="w-full rounded-sm py-1 px-2 bg-[#5F708A] text-white flex justify-center items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="90%" viewBox="0 0 24 24"><path fill="currentColor" fill-rule="evenodd" d="M8 7a4 4 0 1 1 8 0a4 4 0 0 1-8 0m0 6a5 5 0 0 0-5 5a3 3 0 0 0 3 3h12a3 3 0 0 0 3-3a5 5 0 0 0-5-5z" clip-rule="evenodd"/></svg>
                                    </div>
                                    <span >Daftar Pelanggan</span>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('customer.index') }}">
                                <div class="w-[50px] flex justify-start items-center flex-col text-center text-xs/4">
                                    <div class="w-full rounded-sm py-1 px-2 bg-[#5F708A] text-white flex justify-center items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="90%" viewBox="0 0 24 24"><path fill="currentColor" fill-rule="evenodd" d="M8 7a4 4 0 1 1 8 0a4 4 0 0 1-8 0m0 6a5 5 0 0 0-5 5a3 3 0 0 0 3 3h12a3 3 0 0 0 3-3a5 5 0 0 0-5-5z" clip-rule="evenodd"/></svg>
                                    </div>
                                    <span >Daftar Pelanggan</span>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('customer.index') }}">
                                <div class="w-[50px] flex justify-start items-center flex-col text-center text-xs/4">
                                    <div class="w-full rounded-sm py-1 px-2 bg-[#5F708A] text-white flex justify-center items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="90%" viewBox="0 0 24 24"><path fill="currentColor" fill-rule="evenodd" d="M8 7a4 4 0 1 1 8 0a4 4 0 0 1-8 0m0 6a5 5 0 0 0-5 5a3 3 0 0 0 3 3h12a3 3 0 0 0 3-3a5 5 0 0 0-5-5z" clip-rule="evenodd"/></svg>
                                    </div>
                                    <span >Daftar Pelanggan</span>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('customer.index') }}">
                                <div class="w-[50px] flex justify-start items-center flex-col text-center text-xs/4">
                                    <div class="w-full rounded-sm py-1 px-2 bg-[#5F708A] text-white flex justify-center items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="90%" viewBox="0 0 24 24"><path fill="currentColor" fill-rule="evenodd" d="M8 7a4 4 0 1 1 8 0a4 4 0 0 1-8 0m0 6a5 5 0 0 0-5 5a3 3 0 0 0 3 3h12a3 3 0 0 0 3-3a5 5 0 0 0-5-5z" clip-rule="evenodd"/></svg>
                                    </div>
                                    <span >Daftar Pelanggan</span>
                                </div>
                            </a>
                        </li>
                    </ul>
                    
            </div>
        
                <button class="w-full hidden md:w-auto active:scale-[.95] hover:bg-white  transition-all text-white border-2 bg-red-700 hover:text-red-700 border-red-700 font-bold py-1 px-4 rounded-md shadow-sm mt-4">
                    Konfirmasi
                </button>
            </div>
        </div>
    </div>
@endsection