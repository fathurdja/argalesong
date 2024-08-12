@extends('layouts.app')

@section('content')
    <div class="bg-gray-100 p-6 mt-7">
        <!-- Bagian Pencarian dan Tombol Baru -->
        <div class="flex justify-between items-center mb-4">
            <input type="text" placeholder="cari kode / nama" class="border border-gray-400 p-2 rounded-md w-full max-w-md">
            <button class="ml-4 bg-green-500 text-white font-bold py-2 px-4 rounded-md">Baru</button>
        </div>

        <!-- Informasi Pelanggan -->
        <div class="bg-white border border-gray-400 p-4 rounded-md">
            <!-- Bagian Atas: Kode dan Nama Perusahaan -->
            <div class="flex justify-between items-center border-b border-gray-400 pb-2 mb-2">
                <h2 class="text-xl font-bold">PRS348</h2>
                <h2 class="text-xl font-bold">PT Fast Food Indonesia</h2>
                <div class="flex space-x-2">
                    <button class="bg-gray-200 text-black font-bold py-1 px-3 rounded-md">Edit Data</button>
                    <button class="bg-red-200 text-black font-bold py-1 px-3 rounded-md">Hapus</button>
                </div>
            </div>

            <!-- Detail Pelanggan -->
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <p><strong>Tipe Pelanggan :</strong> Perusahaan</p>
                    <p><strong>Tipe Piutang :</strong> Sewa-menyewa</p>
                    <p><strong>NPWP :</strong> 01.234.567.8-123.000</p>
                    <p><strong>Alamat :</strong> Jl. Ahmad Yani No.23-25 Blok B5-B6, Pattunuang, Kec. Wajo</p>
                    <p><strong>E-mail :</strong> kfcahmadyani@gmail.com</p>
                    <p><strong>Whatsapp :</strong> 08512345678</p>
                    <p><strong>Telepon :</strong> -</p>
                    <p><strong>Fax :</strong> -</p>
                </div>
                <div>
                    <p><strong>% Sharing :</strong> 7%</p>
                    <p><strong>Kota :</strong> Makassar</p>
                    <p><strong>Kode Pos :</strong> 90171</p>
                </div>
            </div>

            <!-- Bagian Bawah: Informasi Tambahan -->
            <div class="border-t border-gray-400 pt-2 mt-2 text-sm">
                <p><strong>Diinput oleh :</strong> Username pada 02/10/2008 14:34 WITA</p>
                <p><strong>Terakhir diedit :</strong> Username pada 02/10/2008 14:34 WITA</p>
            </div>
        </div>
    </div>
@endsection
