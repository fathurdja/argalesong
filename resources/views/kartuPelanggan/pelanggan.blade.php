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
        <div class="bg-white p-4">
            <div class=" justify-between items-center mb-2">
                <div class=" justify-between items-center mb-2">
                    <div class="text-lg font-bold">
                        {{ $selectedCustomer->name ?? 'Customer Not Selected' }}
                        <!-- Display the selected customer's name -->
                    </div>
                    <div class="text-sm">
                        Periode: {{ $startDate }} s/d {{ $endDate }} <!-- Display the selected date range -->
                    </div>
                </div>
                <div class="flex overflow-x-auto">
                    <!-- Piutang Section -->
                    <div class="w-2/3 border  min-w-max">
                        <div class="bg-green-500 text-white text-center font-bold">PIUTANG</div>
                        <div class="flex">
                            <div class="w-1/2 border-r min-w-max">
                                <div class="bg-green-500 text-white text-center font-bold">Penagihan Piutang</div>
                                <table class="w-full text-xs">
                                    <thead>
                                        <tr class="bg-gray-300">
                                            <th class="border border-black p-1">Tgl Terbit</th>
                                            <th class="border border-black p-1">No Invoice</th>
                                            <th class="border border-black p-1">No Bukti Jurnal</th>
                                            <th class="border border-black p-1">Keterangan</th>
                                            <th class="border border-black p-1">Nominal</th>
                                            <th class="border border-black p-1">Tgl Jatuh Tempo</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <!-- Baris P0 -->
                                        @foreach ($data as $item)
                                            @if ($item->idrows === 'P0')
                                                <tr class="bg-yellow-100">
                                                    <td class="border border-black p-1">{{ $item->tgltrx }}</td>
                                                    <td class="border border-black p-1">{{ $item->noinvoice }}</td>
                                                    <td class="border border-black p-1">{{ $item->nobuktijurnal }}</td>
                                                    <td class="border border-black p-1">{{ $item->keterangan }}</td>
                                                    <td class="border border-black p-1">
                                                        {{ number_format($item->nominal, 2) }}
                                                    </td>
                                                    <td class="border border-black p-1">{{ $item->tgljtempo }}</td>
                                                </tr>
                                                <!-- Tambahkan baris kosong di bagian pembayaran -->
                                            @endif
                                        @endforeach

                                        <!-- Baris P1 -->
                                        @foreach ($data as $item)
                                            @if ($item->idrows === 'P1')
                                                <tr>
                                                    <td class="border border-black p-1">{{ $item->tgltrx }}</td>
                                                    <td class="border border-black p-1">{{ $item->noinvoice }}</td>
                                                    <td class="border border-black p-1">{{ $item->nobuktijurnal }}</td>
                                                    <td class="border border-black p-1">{{ $item->keterangan }}</td>
                                                    <td class="border border-black p-1">
                                                        {{ number_format($item->nominal, 2) }}
                                                    </td>
                                                    <td class="border border-black p-1">{{ $item->tgljtempo }}</td>
                                                </tr>
                                            @endif
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="w-1/2 min-w-max">
                                <div class="bg-green-500 text-white text-center font-bold">Pembayaran Piutang</div>
                                <table class="w-full text-xs">
                                    <thead>
                                        <tr class="bg-gray-300">
                                            <th class="border border-black p-1">Tgl Bayar</th>
                                            <th class="border border-black p-1">No Bukti Jurnal</th>
                                            <th class="border border-black p-1">Keterangan</th>
                                            <th class="border border-black p-1">Nominal</th>
                                            <th class="border border-black p-1">Diskon</th>
                                            <th class="border border-black p-1">Saldo</th>
                                            <th class="border border-black p-1">Umur Piutang</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($data as $item)
                                            @if ($item->idrows === 'P0')
                                                <tr class="bg-yellow-100">
                                                    <td class="border border-black p-1">{{ $item->tgltrx }}</td>
                                                    <td class="border border-black p-1"></td>
                                                    <td class="border border-black p-1">{{ $item->nobuktijurnal }}</td>
                                                    <td class="border border-black p-1">{{ $item->keterangan }}</td>
                                                    <td class="border border-black p-1">
                                                        {{ number_format($item->nominal, 2) }}
                                                    </td>
                                                    <td class="border border-black p-1">{{ $item->tgljtempo }}</td>
                                                </tr>
                                                <!-- Tambahkan baris kosong di bagian pembayaran -->
                                            @endif
                                        @endforeach
                                        <!-- Baris P2 -->
                                        @foreach ($data as $item)
                                            @if ($item->idrows === 'P2')
                                                <tr>
                                                    <td class="border border-black p-1">{{ $item->tgltrx }}</td>
                                                    <td class="border border-black p-1"></td>
                                                    <td class="border border-black p-1">{{ $item->ketbayar }}</td>
                                                    <td class="border border-black p-1">
                                                        {{ number_format($item->nbayar, 2) }}
                                                    </td>
                                                    <td class="border border-black p-1">0</td>
                                                    <td class="border border-black p-1">
                                                        {{ number_format($item->saldo, 2) }}
                                                    </td>
                                                    <td class="border border-black p-1">###</td>
                                                </tr>
                                            @endif
                                        @endforeach
                                    </tbody>
                                </table>
                                @php
                                    // Ubah array menjadi koleksi dan ambil saldo terakhir dari P2
                                    $saldoTerakhir = collect($data)
                                        ->filter(fn($item) => $item->idrows === 'P2') // Use -> to access object properties
                                        ->last(); // Get the last object in the filtered collection

                                    // Check if $saldoTerakhir exists and safely access the saldo property
                                    $saldoTerakhir = $saldoTerakhir ? $saldoTerakhir->saldo : 0;
                                @endphp

                                <!-- Bagian saldo -->

                                <div class="flex">
                                    <p class="text-right p-2 font-bold">Saldo Terakhir: </p>
                                    <div class="text-right p-2 font-bold">{{ number_format($saldoTerakhir, 2) }}</div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endsection
