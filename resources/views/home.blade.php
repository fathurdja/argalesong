<!-- resources/views/dashboard.blade.php -->

@extends('layouts.app2')


@section('content')
    <div class="flex justify-evenly items-start p-24 bg-gray-300 shadow rounded-lg mt-24">
        <!-- Bagian Kiri: Informasi Perusahaan dan Pengguna -->
        <div class="text-center">
            <h1 class="text-xl font-bold">PT SINAR GALESONG PRATAMA</h1>
            <p class="italic text-gray-500">Departemen <span class="not-italic font-bold">{{ $user->departemen }}</span></p>
            <!-- Gambar Profil -->
            <div class="mt-4">
                <img src="{{ asset('storage/' . Auth::user()->image) }}" alt="Profile Picture"
                    class="w-32 h-32 rounded-full mx-auto">
            </div>
            <p class="mt-4">Hai, <span class="text-blue-500">{{ $user->name }}</span>!</p>
        </div>

        <!-- Bagian Kanan: Tanggal dan Tabel Umur Piutang -->
        <div class="text-right">
            <!-- Tanggal -->
            <p class="text-gray-600">{{ $currentDate }}</p>

            <!-- Tabel Umur Piutang -->
            <div class="mt-6">
                <h2 class="text-lg font-bold mb-2">Umur Piutang</h2>
                <table class="min-w-full bg-gray-500 border border-gray-200">
                    <thead class="bg-slate-900">
                        <tr>
                            <th class="border border-gray-200 px-4 py-2 text-white">No</th>
                            <th class="border border-gray-200 px-4 py-2 text-white">Aging</th>
                            <th class="border border-gray-200 px-4 py-2 text-white">Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="border border-gray-200 px-4 py-2 text-center">1</td>
                            <td class="border border-gray-200 px-4 py-2">> 30 hari</td>
                            <td class="border border-gray-200 px-4 py-2">Rp100,000,000</td>
                        </tr>
                        <tr>
                            <td class="border border-gray-200 px-4 py-2 text-center">2</td>
                            <td class="border border-gray-200 px-4 py-2">> 60 hari</td>
                            <td class="border border-gray-200 px-4 py-2">Rp2,500,000</td>
                        </tr>
                        <tr>
                            <td class="border border-gray-200 px-4 py-2 text-center">3</td>
                            <td class="border border-gray-200 px-4 py-2">> 90 hari</td>
                            <td class="border border-gray-200 px-4 py-2">Rp139,850</td>
                        </tr>
                    </tbody>
                </table>
                <button class="bg-red-600 rounded-md shadow mt-5 px-7">
                    <p class=" text-white">Lakukan konfirmasi!</p>
                </button>

            </div>
        </div>
    </div>
@endsection
