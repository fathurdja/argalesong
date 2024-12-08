@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-4 py-8 ml-12">
        <!-- Form Pencarian -->
        <div class="bg-gray-100 p-6 rounded-lg shadow-md mb-6">
            <form method="POST" action="{{ route('kartu-pelanggan-fetchData') }}">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    <div>
                        <label for="start_date" class="block text-sm font-medium text-gray-700 mb-2">Tanggal Awal</label>
                        <input type="date" name="start_date" id="start_date"
                            value="{{ old('start_date', now()->format('Y-m-d')) }}"
                            class="w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                            required>
                    </div>
                    <div>
                        <label for="end_date" class="block text-sm font-medium text-gray-700 mb-2">Tanggal Akhir</label>
                        <input type="date" name="end_date" id="end_date"
                            value="{{ old('end_date', now()->format('Y-m-d')) }}"
                            class="w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                            required>
                    </div>
                    <div>
                        <label for="tipePelanggan" class="block text-sm font-medium text-gray-700 mb-2">Tipe
                            Pelanggan</label>
                        <select id="tipePelanggan" name="tipePelanggan"
                            class="block w-full border-gray-300 rounded-md shadow-sm p-2 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                            <option value="">-- Pilih Tipe Pelanggan --</option>
                            @foreach ($tipePelanggan as $type)
                                <option value="{{ $type->kodeType }}"
                                    {{ $selectedTipePelanggan == $type->kodeType ? 'selected' : '' }}>
                                    {{ $type->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="mt-4">
                    <label for="nama_pelanggan" class="block text-sm font-medium text-gray-700 mb-2">Pilih Pelanggan</label>
                    <select name="nama_pelanggan" id="nama_pelanggan"
                        class="border border-gray-300 rounded-md shadow-sm w-full p-2 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                        required>
                        <option value="">-- Pilih Pelanggan --</option>
                        @foreach ($customers as $customer)
                            <option value="{{ $customer->id_Pelanggan }}">{{ $customer->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mt-4 text-right">
                    <button type="submit"
                        class="px-6 py-2 bg-blue-500 text-white font-medium rounded-md shadow-sm hover:bg-blue-600 focus:ring focus:ring-blue-300">
                        Cari
                    </button>
                </div>
            </form>
        </div>

        <!-- Data Piutang, Pembayaran, dan Denda -->
        <div class="bg-green-100 border border-green-500 rounded-lg shadow-md p-8">
            <h2 class="bg-green-500 text-white text-center font-semibold py-3 rounded-t-lg">
                Data Piutang dan Pembayaran
            </h2>
            <div class="overflow-x-auto">
                <table class="w-full table-auto border-collapse border border-gray-200 text-sm">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="px-6 py-3 border text-gray-700 text-center">Tanggal Piutang</th>
                            <th class="px-6 py-3 border text-gray-700 text-center">No Invoice</th>
                            <th class="px-6 py-3 border text-gray-700 text-center">No Bukti Jurnal</th>
                            <th class="px-6 py-3 border text-gray-700 text-center">Keterangan Piutang</th>
                            <th class="px-6 py-3 border text-gray-700 text-right">Nominal</th>
                            <th class="px-6 py-3 border text-gray-700 text-center">Tanggal Jatuh Tempo</th>
                            <th class="px-6 py-3 border text-gray-700 text-center">Tanggal Bayar</th>
                            <th class="px-6 py-3 border text-gray-700 text-center">No Jurnal Bayar</th>
                            <th class="px-6 py-3 border text-gray-700 text-center">No Bukti Bayar</th>
                            <th class="px-6 py-3 border text-gray-700 text-center">Keterangan Bayar</th>
                            <th class="px-6 py-3 border text-gray-700 text-right">Nominal Bayar</th>
                            <th class="px-6 py-3 border text-gray-700 text-right">Saldo</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($data as $item)
                            <tr>
                                <td class="px-6 py-3 border text-gray-700 text-center">{{ $item['tglpiutang'] ?? '-' }}</td>
                                <td class="px-6 py-3 border text-gray-700 text-center">{{ $item['noinvoice'] ?? '-' }}</td>
                                <td class="px-6 py-3 border text-gray-700 text-center">{{ $item['nobuktijurnal'] ?? '-' }}
                                </td>
                                <td class="px-6 py-3 border text-gray-700">{{ $item['keterangan'] ?? '-' }}</td>
                                <td class="px-6 py-3 border text-gray-700 text-right">
                                    {{ number_format($item['nominal'] ?? 0, 2, ',', '.') }}
                                </td>
                                <td class="px-6 py-3 border text-gray-700 text-center">{{ $item['tgljtempo'] ?? '-' }}</td>
                                <td class="px-6 py-3 border text-gray-700 text-center">{{ $item['tglbayar'] ?? '-' }}</td>
                                <td class="px-6 py-3 border text-gray-700 text-center">{{ $item['nojrbayar'] ?? '-' }}</td>
                                <td class="px-6 py-3 border text-gray-700 text-center">{{ $item['nobuktibayar'] ?? '-' }}
                                </td>
                                <td class="px-6 py-3 border text-gray-700">{{ $item['ketbayar'] ?? '-' }}</td>
                                <td class="px-6 py-3 border text-gray-700 text-right">
                                    {{ number_format($item['nbayar'] ?? 0, 2, ',', '.') }}
                                </td>
                                <td class="px-6 py-3 border text-gray-700 text-right">
                                    {{ number_format(($item['saldo'] ?? 0) < 10 ? 0 : $item['saldo'], 2, ',', '.') }}
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="12" class="px-6 py-3 text-center text-gray-500">Tidak ada data ditemukan.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        <div class="bg-red-100 border border-red-500 rounded-lg shadow-md">
            <h2 class="bg-red-500 text-white text-center font-semibold py-2">DENDA</h2>
            <div class="overflow-x-auto p-6">
                <table class="w-full table-auto border-collapse border border-gray-200">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="px-4 py-2 border text-sm font-medium text-gray-700" rowspan="2">Nomor Invoice
                            </th>
                            <th class="px-4 py-2 border text-sm font-medium text-gray-700" rowspan="2">Nominal Denda
                            </th>
                            <th class="px-4 py-2 border text-sm font-medium text-gray-700" colspan="4">Pembayaran
                                Denda</th>
                            <th class="px-4 py-2 border text-sm font-medium text-gray-700" colspan="4">Penghapusan
                                Denda</th>
                            <th class="px-4 py-2 border text-sm font-medium text-gray-700" rowspan="2">Saldo</th>
                        </tr>
                        <tr>
                            <th class="px-4 py-2 border text-sm font-medium text-gray-700">Tgl Bayar</th>
                            <th class="px-4 py-2 border text-sm font-medium text-gray-700">No Bukti Jurnal</th>
                            <th class="px-4 py-2 border text-sm font-medium text-gray-700">Keterangan</th>
                            <th class="px-4 py-2 border text-sm font-medium text-gray-700">Nominal</th>
                            <th class="px-4 py-2 border text-sm font-medium text-gray-700">Tgl Hapus</th>
                            <th class="px-4 py-2 border text-sm font-medium text-gray-700">Memo</th>
                            <th class="px-4 py-2 border text-sm font-medium text-gray-700">Keterangan</th>
                            <th class="px-4 py-2 border text-sm font-medium text-gray-700">Nominal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($secondResult as $denda)
                            <tr>
                                <td class="px-4 py-2 border text-sm text-gray-700 text-center">
                                    {{ $denda['noinvoice'] }}
                                </td>
                                <td class="px-4 py-2 border text-sm text-gray-700 text-center">
                                    {{ number_format($denda['nominal'] ?? 0, 2, ',', '.') }}
                                </td>
                                <td class="px-4 py-2 border text-sm text-gray-700 text-center">-</td>
                                <td class="px-4 py-2 border text-sm text-gray-700 text-center">-</td>
                                <td class="px-4 py-2 border text-sm text-gray-700 text-center">-</td>
                                <td class="px-4 py-2 border text-sm text-gray-700 text-center">-</td>
                                <td class="px-4 py-2 border text-sm text-gray-700 text-center">-</td>
                                <td class="px-4 py-2 border text-sm text-gray-700 text-center">-</td>
                                <td class="px-4 py-2 border text-sm text-gray-700 text-center">-</td>
                                <td class="px-4 py-2 border text-sm text-gray-700 text-center">-</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="12" class="px-6 py-3 text-center text-gray-500">Tidak ada data ditemukan.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
