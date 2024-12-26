@extends('layouts.app')

@section('content')
    <div class="mx-auto mt-10">
        <div class="overflow-x-auto bg-white rounded-xl ml-20 px-6 py-10">
            <form method="GET" action="{{ route('riwayatPiutang') }}" class="mb-6" id="filterForm">
                <label for="idcompany" class="mr-2 text-gray-700 font-bold">Pilih Group:</label>
                <input list="groupList" name="idcompany" id="idcompany" class="border border-gray-300 p-2 rounded-md w-96"
                    placeholder="Search group..." value="{{ request('idcompany') }}">
                <datalist id="groupList">
                    <option value="">-- Semua Group --</option>
                    @foreach ($perusahaan as $group)
                        <option value="{{ $group->company_id }}">
                            {{ $group->name }}
                        </option>
                    @endforeach
                </datalist>
            </form>

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

            <div class="mt-4">
                {{ $piutang->links() }}
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const input = document.getElementById('idcompany');
            const form = document.getElementById('filterForm');

            // Kirim form secara otomatis saat input berubah
            input.addEventListener('change', function() {
                form.submit();
            });
        });
    </script>
@endpush
