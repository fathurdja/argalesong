@extends('layouts.app')

@section('content')
    <div class="bg-gray-100 p-6">
        <!-- DATA PELANGGAN -->
        <div class="bg-white border border-gray-400 p-4 rounded-md mb-6">
            <h2 class="text-center text-lg font-bold mb-4 border-b border-gray-400 pb-2">DATA PELANGGAN</h2>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <p><strong>Tipe Pelanggan :</strong>
                        <select class="border border-gray-300 p-2 rounded-md w-full">
                            <option>Perusahaan</option>
                        </select>
                    </p>
                    <p class="mt-2"><strong>Tipe Piutang :</strong>
                        <select class="border border-gray-300 p-2 rounded-md w-full">
                            <option>Sewa-menyewa</option>
                        </select>
                    </p>
                    <p class="mt-2"><strong>Nama Pelanggan :</strong>
                        <input type="text" class="border border-gray-300 p-2 rounded-md w-full" placeholder="wajib diisi">
                    </p>
                    <p class="mt-2"><strong>KTP :</strong>
                        <select class="border border-gray-300 p-2 rounded-md w-full">
                            <option>Tidak Ada</option>
                        </select>
                        <span class="text-sm text-gray-500">wajib isi 16 digit KTP, jika tdk sesuai, remind</span>
                    </p>
                    <p class="mt-2"><strong>NPWP :</strong>
                        <select class="border border-gray-300 p-2 rounded-md w-full">
                            <option>Ada</option>
                        </select>
                        <span class="text-sm text-gray-500">wajib isi 15 digit NPWP, jika tdk sesuai, remind</span>
                    </p>
                </div>

                <div>
                    <p><strong>Kode Pelanggan :</strong> <input type="text"
                            class="border border-gray-300 p-2 rounded-md w-full" disabled></p>
                    <p class="mt-2"><strong>% Sharing :</strong> <input type="text"
                            class="border border-gray-300 p-2 rounded-md w-full"></p>
                </div>
            </div>
        </div>

        <!-- KONTAK PELANGGAN -->
        <div class="bg-white border border-gray-400 p-4 rounded-md">
            <h2 class="text-center text-lg font-bold mb-4 border-b border-gray-400 pb-2">KONTAK PELANGGAN</h2>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <p><strong>Alamat :</strong>
                        <input type="text" class="border border-gray-300 p-2 rounded-md w-full"
                            placeholder="wajib diisi">
                    </p>
                    <p class="mt-2"><strong>E-mail :</strong>
                        <input type="email" class="border border-gray-300 p-2 rounded-md w-full"
                            placeholder="wajib diisi">
                    </p>
                    <p class="mt-2"><strong>Whatsapp :</strong>
                        <input type="text" class="border border-gray-300 p-2 rounded-md w-full"
                            placeholder="wajib diisi">
                    </p>
                    <p class="mt-2"><strong>Telepon :</strong>
                        <input type="text" class="border border-gray-300 p-2 rounded-md w-full" placeholder="opsional">
                    </p>
                    <p class="mt-2"><strong>Fax :</strong>
                        <input type="text" class="border border-gray-300 p-2 rounded-md w-full" placeholder="opsional">
                    </p>
                </div>

                <div>
                    <p><strong>Kota :</strong>
                        <input type="text" class="border border-gray-300 p-2 rounded-md w-full"
                            placeholder="wajib diisi">
                    </p>
                    <p class="mt-2"><strong>Kode Pos :</strong>
                        <input type="text" class="border border-gray-300 p-2 rounded-md w-full"
                            placeholder="wajib diisi">
                    </p>
                    <p class="mt-2"><strong>Catatan :</strong>
                        <input type="text" class="border border-gray-300 p-2 rounded-md w-full" placeholder="opsional">
                    </p>
                </div>
            </div>
        </div>

        <!-- Tombol Simpan dan Batal -->
        <div class="mt-6">
            <button class="bg-green-500 text-white font-bold py-2 px-4 rounded-md mr-2">Simpan</button>
            <button class="bg-white border border-gray-400 text-black font-bold py-2 px-4 rounded-md">Batal</button>
        </div>
    </div>
@endsection
