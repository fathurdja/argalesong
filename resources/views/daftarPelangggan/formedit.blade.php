@extends('layouts.app')

@section('content')
    <div class="bg-gray-100 p-6 mt-7 ml-9">


        <!-- Bagian Pencarian dan Tombol Baru -->
        <div class="flex justify-between items-center mb-4">

            <form action="{{ route('customer.index') }}" method="GET" class="w-full max-w-md flex">
                <input type="text" name="search" placeholder="cari kode / nama"
                    class="border border-gray-400 p-2 rounded-md flex-grow" value="{{ request('search') }}">
                <button type="submit" class="ml-4 bg-green-500 text-white font-bold py-2 px-4 rounded-md">
                    Cari
                </button>
            </form>
            <a href="{{ route('customer.create') }}">
                <button class="ml-4 bg-green-500 text-white font-bold py-2 px-4 rounded-md">Baru</button>
            </a>
        </div>
        <div>
            <h1 class="text-3xl py-3 font-semibold">DAFTAR PELANGGAN</h1>
        </div>
        @if (isset($customer))
            <!-- Informasi Pelanggan -->
            <div class="bg-white border border-gray-400 p-4 rounded-md">
                <!-- Bagian Atas: Kode dan Nama Perusahaan -->
                <div class="flex justify-between items-center border-b border-gray-400 pb-2 mb-2">
                    <h2 class="text-xl font-bold">{{ $customer->id_Pelanggan }}</h2>
                    <h2 class="text-xl font-bold">{{ $customer->name }}</h2>
                    <div class="flex space-x-2">
                        <a href="{{ route('customer.edit', $customer->id) }}"><button
                                class="bg-green-700 text-black font-bold py-1 px-3 rounded-md">Edit Data</button></a>
                        <button class="bg-red-600 text-black font-bold py-1 px-3 rounded-md">Hapus</button>
                    </div>
                </div>

                <!-- Detail Pelanggan -->
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <p><strong>Tipe Pelanggan :</strong> {{ $tipePelangganName }}</p>

                        <p><strong>NPWP :</strong> {{ $customer->npwp }}</p>
                        <p><strong>Alamat :</strong> {{ $customer->alamat }}</p>
                        <p><strong>E-mail :</strong> {{ $customer->email }}</p>
                        <p><strong>Whatsapp :</strong> {{ $customer->whatsapp }}</p>
                        <p><strong>Telepon :</strong> {{ $customer->telepon }}</p>
                        <p><strong>Fax :</strong> {{ $customer->fax }}</p>
                    </div>
                    <div>
                        <p><strong>% Sharing :</strong> {{ $customer->sharing }}%</p>
                        <p><strong>Kota :</strong> {{ $customer->kota }}</p>
                        <p><strong>Kode Pos :</strong> {{ $customer->kode_pos }}</p>
                    </div>
                </div>

                <!-- Bagian Bawah: Informasi Tambahan -->
                <div class="border-t border-gray-400 pt-2 mt-2 text-sm flex justify-between">
                    <p><strong>Di input oleh :</strong> {{ Auth::user()->name }} on
                        {{ $customer->created_at->format('l d/m/Y') }}</p>
                    <p><strong>Terakhir diedit :</strong> {{ Auth::user()->name }} on
                        {{ $customer->updated_at->format('l d/m/Y') }}</p>
                </div>
            </div>
        @else
            @foreach ($daftarPelanggan as $pelanggan)
                <div class="bg-white border border-gray-400 p-4 rounded-md mb-5">
                    <!-- Bagian Atas: Kode dan Nama Perusahaan -->
                    <div class="flex justify-between items-center border-b border-gray-400 pb-2 mb-2">
                        <h2 class="text-xl font-bold">{{ $pelanggan->id_Pelanggan }}</h2>
                        <h2 class="text-xl font-bold">{{ $pelanggan->name }}</h2>
                        <div class="flex space-x-2">
                            <a href="{{ route('customer.edit', $pelanggan->id) }}"><button
                                    class="bg-green-700 text-black font-bold py-1 px-3 rounded-md">Edit Data</button></a>
                            <button class="bg-red-600 text-black font-bold py-1 px-3 rounded-md">Hapus</button>
                        </div>
                    </div>

                    <!-- Detail Pelanggan -->
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <p><strong>Tipe Pelanggan :</strong> {{ $pelanggan->tipePelanggan->name }}</p>

                            <p><strong>NPWP :</strong> {{ $pelanggan->npwp }}</p>
                            <p><strong>Alamat :</strong> {{ $pelanggan->alamat }}</p>
                            <p><strong>E-mail :</strong> {{ $pelanggan->email }}</p>
                            <p><strong>Whatsapp :</strong> {{ $pelanggan->whatsapp }}</p>
                            <p><strong>Telepon :</strong> {{ $pelanggan->telepon }}</p>
                            <p><strong>Fax :</strong> {{ $pelanggan->fax }}</p>
                        </div>
                        <div>
                            <p><strong>% Sharing :</strong> {{ $pelanggan->sharing }}%</p>
                            <p><strong>Kota :</strong> {{ $pelanggan->kota }}</p>
                            <p><strong>Kode Pos :</strong> {{ $pelanggan->kode_pos }}</p>
                        </div>
                    </div>

                    <!-- Bagian Bawah: Informasi Tambahan -->
                    <div class="border-t border-gray-400 pt-2 mt-2 text-sm flex justify-between">
                        <p><strong>Di input oleh :</strong> {{ Auth::user()->name }} on
                            {{ $pelanggan->created_at->format('l d/m/Y') }}</p>
                        <p><strong>Terakhir diedit :</strong> {{ Auth::user()->name }} on
                            {{ $pelanggan->updated_at->format('l d/m/Y') }}</p>
                    </div>
                </div>
            @endforeach
            <div>{{ $daftarPelanggan->links() }}</div>
            <!-- Informasi Tidak Ditemukan -->
        @endif
    </div>
@endsection
