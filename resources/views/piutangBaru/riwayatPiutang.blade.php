@extends('layouts.app')

@section('content')
    <div class="mx-auto mt-10">
        <div class="overflow-x-auto bg-white rounded-xl ml-20 px-6 py-10">
            <table class="min-w-full">
                <thead>
                    <tr>
                        <th colspan="14" class="border p-2 text-left text-xl">Halaman Riwayat Pengajuan Piutang</th>
                    </tr>
                    <tr>
                        <th class="border border-gray-400 p-2">ID</th>
                        <th class="border border-gray-400 p-2">Jenis Piutang</th>
                        <th class="border border-gray-400 p-2">Tanggal Transaksi</th>
                        <th class="border border-gray-400 p-2">Jatuh Tempo</th>
                        <th class="border border-gray-400 p-2">Tipe Pelanggan</th>
                        <th class="border border-gray-400 p-2">Nama Pelanggan</th>
                        <th class="border border-gray-400 p-2">Jenis Tagihan</th>
                        <th class="border border-gray-400 p-2">DPP</th>
                        <th class="border border-gray-400 p-2">PPN</th>
                        <th class="border border-gray-400 p-2">PPH</th>
                        <th class="border border-gray-400 p-2">Total Piutang</th>
                        <th class="border border-gray-400 p-2">Sisa</th>
                        <th class="border border-gray-400 p-2">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($piutang as $item)
                        <tr>
                            <td class="border border-gray-400 p-2 underline text-blue-600">
                                <a href="">{{ $item->no_invoice }}</a>
                            </td>
                            <td class="border border-gray-400 p-2">{{ $item->tipepiutang }}</td>
                            <td class="border border-gray-400 p-2">{{ $item->tgltra }}</td>
                            <td class="border border-gray-400 p-2">{{ $item->tgl_jatuh_tempo }}</td>
                            <td class="border border-gray-400 p-2">{{ $item->tipe_pelanggan }}</td>
                            <td class="border border-gray-400 p-2">{{ $item->customer_name }}</td>
                            <td class="border border-gray-400 p-2">{{ $item->jenistagihan }}</td>
                            <td class="border border-gray-400 p-2">{{ number_format($item->dpp, 2) }}</td>
                            <td class="border border-gray-400 p-2">{{ number_format($item->ppn, 2) }}</td>
                            <td class="border border-gray-400 p-2">{{ number_format($item->pph, 2) }}</td>
                            <td class="border border-gray-400 p-2">{{ number_format($item->nominal, 2) }}</td>
                            <td class="border border-gray-400 p-2">{{ number_format($item->tagihan, 2) }}</td>
                            <td
                                class="border border-gray-400 p-2 
                                @if ($item->statusPembayaran == 'LUNAS') bg-green-500 text-white
                                @elseif($item->statusPembayaran == 'SEBAGIAN') bg-yellow-500 text-white
                                @else bg-red-500 text-white @endif">
                                {{ $item->statusPembayaran }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
