@extends('layouts.app')

@section('content')
    <div class="mx-auto ml-10">
        <div class="bg-white rounded-xl px-6 py-10 max-w-full">
            <!-- Form Filter -->
            <form method="GET" action="{{ route('riwayatPiutang') }}" class="mb-6" id="filterForm">
                <label for="idcompany" class="mr-2 text-gray-700 font-bold">Pilih Group:</label>
                <input list="groupList" name="idcompany" id="idcompany" class="border border-gray-300 p-2 rounded-md w-96"
                    placeholder="Search group..." value="{{ request('idcompany') }}">
                <datalist id="groupList">
                    <option value="">-- Semua Group --</option>
                    @foreach ($perusahaan as $group)
                        <option value="{{ $group->company_id }}">{{ $group->name }}</option>
                    @endforeach
                </datalist>
            </form>

            <!-- Tabel Data -->
            <div class="overflow-x-auto">
                <table class="min-w-full table-fixed border-collapse border border-gray-400">
                    <thead>
                        <tr>
                            <th colspan="14" class="border p-2 text-left text-xl bg-gray-100">Halaman Riwayat Pengajuan
                                Piutang</th>
                        </tr>
                        <tr class="bg-gray-200">
                            <th class="border border-gray-400 p-2 w-20">ID</th>
                            <th class="border border-gray-400 p-2 w-40">Jenis Piutang</th>
                            <th class="border border-gray-400 p-2 w-40">Tanggal Transaksi</th>
                            <th class="border border-gray-400 p-2 w-40">Jatuh Tempo</th>
                            <th class="border border-gray-400 p-2 w-40">Tipe Pelanggan</th>
                            <th class="border border-gray-400 p-2 w-56">Nama Pelanggan</th>
                            <th class="border border-gray-400 p-2 w-40">Jenis Tagihan</th>
                            <th class="border border-gray-400 p-2 w-32">DPP</th>
                            <th class="border border-gray-400 p-2 w-32">PPN</th>
                            <th class="border border-gray-400 p-2 w-32">PPH</th>
                            <th class="border border-gray-400 p-2 w-40">Total Piutang</th>
                            <th class="border border-gray-400 p-2 w-40">Dibuat Oleh</th>
                            <th class="border border-gray-400 p-2 w-32">Sisa</th>
                            <th class="border border-gray-400 p-2 w-32">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($piutang as $item)
                            <tr class="hover:bg-gray-100">
                                <td class="border border-gray-400 p-2 underline text-blue-600 truncate">
                                    <a href="{{ route('printriwayatPiutang', ['nomor_invoice' => $item->no_invoice]) }}">
                                        {{ $item->no_invoice }}
                                    </a>
                                </td>
                                <td class="border border-gray-400 p-2 truncate">{{ $item->tipepiutang }}</td>
                                <td class="border border-gray-400 p-2 truncate">{{ $item->tgltra }}</td>
                                <td class="border border-gray-400 p-2 truncate">{{ $item->tgl_jatuh_tempo }}</td>
                                <td class="border border-gray-400 p-2 truncate">{{ $item->tipe_pelanggan }}</td>
                                <td class="border border-gray-400 p-2 truncate">{{ $item->customer_name }}</td>
                                <td class="border border-gray-400 p-2 truncate">{{ $item->jenistagihan }}</td>
                                <td class="border border-gray-400 p-2 truncate">{{ number_format($item->dpp, 2) }}</td>
                                <td class="border border-gray-400 p-2 truncate">{{ number_format($item->ppn, 2) }}</td>
                                <td class="border border-gray-400 p-2 truncate">{{ number_format($item->pph, 2) }}</td>
                                <td class="border border-gray-400 p-2 truncate">{{ number_format($item->nominal, 2) }}</td>
                                <td class="border border-gray-400 p-2 truncate">{{ $item->created_by ?? 'GL' }}</td>
                                <td class="border border-gray-400 p-2 truncate">{{ number_format($item->tagihan, 2) }}</td>
                                <td
                                    class="border border-gray-400 p-2 
                                    @if ($item->statusPembayaran == 'LUNAS') bg-green-500 text-white
                                    @elseif($item->statusPembayaran == 'SEBAGIAN') bg-yellow-500 text-white
                                    @else bg-red-500 text-white @endif truncate">
                                    {{ $item->statusPembayaran }}
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="14" class="border border-gray-400 p-4 text-center text-gray-500">
                                    Data tidak ditemukan.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="mt-4">
                {{ $piutang->appends(request()->query())->links() }}
            </div>
        </div>
    </div>
@endsection

@push('scripts')
@vite('resources/js/test.js') 
@endpush
