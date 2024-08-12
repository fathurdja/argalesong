@extends('layouts.app')

@section('content')
    <div class="container mx-auto mt-10">
        <div class="bg-white shadow-md rounded-lg p-6">
            <h2 class="text-lg font-bold mb-4">PIUTANG BARU: SEWA-MENYEWA</h2>

            <form action="" method="POST">
                @csrf

                <div class="grid grid-cols-2 gap-4 mb-4">
                    <div>
                        <label for="tanggal_transaksi" class="block text-sm font-medium text-gray-700">Tanggal
                            Transaksi</label>
                        <input type="date" name="tanggal_transaksi" id="tanggal_transaksi"
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    </div>

                    <div>
                        <label for="jatuh_tempo" class="block text-sm font-medium text-gray-700">Jatuh Tempo</label>
                        <input type="date" name="jatuh_tempo" id="jatuh_tempo"
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    </div>
                </div>

                <div class="mb-4">
                    <label for="denda" class="block text-sm font-medium text-gray-700">Jika Jatuh Tempo</label>
                    <select id="denda" name="denda"
                        class="mt-1 block w-full bg-white border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        <option>Denda</option>
                        <option>Lainnya</option>
                    </select>
                </div>

                <div class="mb-4">
                    <label for="nama_pelanggan" class="block text-sm font-medium text-gray-700">Nama Pelanggan</label>
                    <input type="text" name="nama_pelanggan" id="nama_pelanggan"
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                </div>

                <div class="mb-4">
                    <label for="tagihan" class="block text-sm font-medium text-gray-700">Tagihan</label>
                    <select id="tagihan" name="tagihan"
                        class="mt-1 block w-full bg-white border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        <option>Tetap</option>
                        <option>Berulang</option>
                    </select>
                </div>

                <div class="mb-4">
                    <label for="pajak" class="block text-sm font-medium text-gray-700">Pajak</label>
                    <div class="flex items-center">
                        <input id="ppn" name="pajak[]" value="PPN" type="checkbox"
                            class="h-4 w-4 text-indigo-600 border-gray-300 rounded">
                        <label for="ppn" class="ml-2 block text-sm text-gray-900">PPN</label>
                    </div>
                    <div class="flex items-center">
                        <input id="pph23" name="pajak[]" value="PPh 23" type="checkbox"
                            class="h-4 w-4 text-indigo-600 border-gray-300 rounded">
                        <label for="pph23" class="ml-2 block text-sm text-gray-900">PPh 23</label>
                    </div>
                    <div class="flex items-center">
                        <input id="pph42" name="pajak[]" value="PPh 4(2)" type="checkbox"
                            class="h-4 w-4 text-indigo-600 border-gray-300 rounded">
                        <label for="pph42" class="ml-2 block text-sm text-gray-900">PPh 4(2)</label>
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-4 mb-4">
                    <div>
                        <label for="dpp" class="block text-sm font-medium text-gray-700">DPP</label>
                        <input type="number" name="dpp" id="dpp"
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    </div>

                    <div>
                        <label for="ppn_value" class="block text-sm font-medium text-gray-700">PPN</label>
                        <input type="number" name="ppn_value" id="ppn_value"
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    </div>

                    <div>
                        <label for="total_piutang" class="block text-sm font-medium text-gray-700">Total Piutang</label>
                        <input type="number" name="total_piutang" id="total_piutang"
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    </div>
                </div>

                <div class="mb-4">
                    <label for="keterangan" class="block text-sm font-medium text-gray-700">Keterangan</label>
                    <textarea name="keterangan" id="keterangan"
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"></textarea>
                </div>

                <div class="flex justify-end">
                    <button type="submit"
                        class="bg-green-500 text-white px-4 py-2 rounded-md hover:bg-green-600">Posting</button>
                    <button type="reset"
                        class="ml-4 bg-gray-500 text-white px-4 py-2 rounded-md hover:bg-gray-600">Batal</button>
                </div>
            </form>
        </div>

        <div class="mt-10 bg-white shadow-md rounded-lg p-6">
            <h3 class="text-lg font-bold mb-4">Jurnal yg Terbentuk</h3>
            <table class="min-w-full table-auto">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Akun</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jumlah
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Piutang Sewa</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Rp ...</td>
                    </tr>
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Piutang PPh 4 Ayat 2 yg akan diterima
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Rp ...</td>
                    </tr>
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Pendapatan Sewa</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Rp ...</td>
                    </tr>
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Hutang PPN Keluaran</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Rp ...</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
@endsection
