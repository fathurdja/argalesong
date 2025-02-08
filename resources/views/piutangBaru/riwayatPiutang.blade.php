@extends('layouts.app')

@section('content')
    <div class="min-w-full flex flex-col justify-center">
        <div class="bg-white rounded-xl px-2 py-5 !container ">
            <!-- Form Filter -->
            <form method="GET" action="{{ route('riwayatPiutang') }}" class="mb-6 flex flex-row justify-start items-center" id="filterForm">
                <label for="idcompany" class="mr-2 text-gray-700 font-bold">Pilih Group:</label>
                <input list="groupList" name="idcompany" id="idcompany" class="border border-gray-300 p-2 rounded-md w-full sm:w-1/2 lg:w-1/3 focus:outline-blue-600"
                    placeholder="Search group..." value="{{ request('idcompany') }}">
                <datalist id="groupList">
                    <option value="">-- Semua Group --</option>
                    @foreach ($perusahaan as $group)
                        <option value="{{ $group->company_id }}">{{ $group->name }}</option>
                    @endforeach
                </datalist>
            </form>

            <!-- Tabel Data -->
            <div class="">
                <h2 class=" p-2 text-left text-xl ">Halaman Riwayat Pengajuan
                    Piutang</h2>
                {{-- <div class="md:overflow-x-auto">
                    <table class="min-w-full table-fixed border-collapse border  border-gray-400">
                        <thead>
                
                            <tr class="bg-gray-200">
                               <th class="border border-gray-400 p-2">ID</th>
                                <th class="border border-gray-400 p-2">Jenis Piutang</th>
                                <th class="border border-gray-400 p-2">Tanggal Transaksi</th>
                                <th class="border border-gray-400 p-2 md:hidden table-cell ">Aksi</th>
                                <th class="border border-gray-400 p-2 md:table-cell hidden">Jatuh Tempo</th>
                                <th class="border border-gray-400 p-2 md:table-cell hidden">Tipe Pelanggan</th>
                                <th class="border border-gray-400 p-2 md:table-cell hidden">Nama Pelanggan</th>
                                <th class="border border-gray-400 p-2 md:table-cell hidden">Jenis Tagihan</th>
                                <th class="border border-gray-400 p-2 md:table-cell hidden">DPP</th>
                                <th class="border border-gray-400 p-2 md:table-cell hidden">PPN</th>
                                <th class="border border-gray-400 p-2 md:table-cell hidden">PPH</th>
                                <th class="border border-gray-400 p-2 md:table-cell hidden">Total Piutang</th>
                                <th class="border border-gray-400 p-2 md:table-cell hidden">Dibuat Oleh</th>
                                <th class="border border-gray-400 p-2 md:table-cell hidden">Sisa</th>
                                <th class="border border-gray-400 p-2 md:table-cell hidden">Status</th>
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
                                    <th class="border border-gray-400 p-2 md:hidden table-cell text-center"><svg xmlns="http://www.w3.org/2000/svg" width="20" viewBox="0 0 48 48"><path fill="#2196f3" d="M17.1 5L14 8.1L29.9 24L14 39.9l3.1 3.1L36 24z"/></svg></th>
                                    <td class="border border-gray-400 p-2 md:table-cell hidden truncate">{{ $item->tgl_jatuh_tempo }}</td>
                                    <td class="border border-gray-400 p-2 md:table-cell hidden truncate">{{ $item->tipe_pelanggan }}</td>
                                    <td class="border border-gray-400 p-2 md:table-cell hidden truncate">{{ $item->customer_name }}</td>
                                    <td class="border border-gray-400 p-2 md:table-cell hidden truncate">{{ $item->jenistagihan }}</td>
                                    <td class="border border-gray-400 p-2 md:table-cell hidden truncate">{{ number_format($item->dpp, 2) }}</td>
                                    <td class="border border-gray-400 p-2 md:table-cell hidden truncate">{{ number_format($item->ppn, 2) }}</td>
                                    <td class="border border-gray-400 p-2 md:table-cell hidden truncate">{{ number_format($item->pph, 2) }}</td>
                                    <td class="border border-gray-400 p-2 md:table-cell hidden truncate">{{ number_format($item->nominal, 2) }}</td>
                                    <td class="border border-gray-400 p-2 md:table-cell hidden truncate">{{ $item->created_by ?? 'GL' }}</td>
                                    <td class="border border-gray-400 p-2 md:table-cell hidden truncate">{{ number_format($item->tagihan, 2) }}</td>
                                    <td
                                        class="border border-gray-400 p-2  md:table-cell hidden
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
                </div> --}}
                {{-- <div class="overflow-hidden md:overflow-x-auto">
                    <table class="min-w-full table-fixed border-collapse border border-gray-400 text-xs sm:text-sm">
                        <thead>
                            <tr class="bg-gray-200">
                                <th class="border border-gray-400 p-2 w-20">ID</th>
                                <th class="border border-gray-400 p-2 w-32">Jenis Piutang</th>
                                <th class="border border-gray-400 p-2 w-32">Tanggal Transaksi</th>
                                <th class="border border-gray-400 p-2 w-16 text-center md:hidden">Aksi</th>
                                <th class="border border-gray-400 p-2 hidden md:table-cell">Jatuh Tempo</th>
                                <th class="border border-gray-400 p-2 hidden md:table-cell">Tipe Pelanggan</th>
                                <th class="border border-gray-400 p-2 hidden md:table-cell">Nama Pelanggan</th>
                                <th class="border border-gray-400 p-2 hidden md:table-cell">Jenis Tagihan</th>
                                <th class="border border-gray-400 p-2 hidden md:table-cell">DPP</th>
                                <th class="border border-gray-400 p-2 hidden md:table-cell">PPN</th>
                                <th class="border border-gray-400 p-2 hidden md:table-cell">PPH</th>
                                <th class="border border-gray-400 p-2 hidden md:table-cell">Total Piutang</th>
                                <th class="border border-gray-400 p-2 hidden md:table-cell">Dibuat Oleh</th>
                                <th class="border border-gray-400 p-2 hidden md:table-cell">Sisa</th>
                                <th class="border border-gray-400 p-2 hidden md:table-cell">Status</th>
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
                                    <td class="border border-gray-400 p-2 md:hidden text-center">
                                        <button class="p-1 bg-blue-500 text-white rounded text-xs">
                                            Detail
                                        </button>
                                    </td>
                                    <td class="border border-gray-400 p-2 hidden md:table-cell">{{ $item->tgl_jatuh_tempo }}</td>
                                    <td class="border border-gray-400 p-2 hidden md:table-cell">{{ $item->tipe_pelanggan }}</td>
                                    <td class="border border-gray-400 p-2 hidden md:table-cell">{{ $item->customer_name }}</td>
                                    <td class="border border-gray-400 p-2 hidden md:table-cell">{{ $item->jenistagihan }}</td>
                                    <td class="border border-gray-400 p-2 hidden md:table-cell">{{ number_format($item->dpp, 2) }}</td>
                                    <td class="border border-gray-400 p-2 hidden md:table-cell">{{ number_format($item->ppn, 2) }}</td>
                                    <td class="border border-gray-400 p-2 hidden md:table-cell">{{ number_format($item->pph, 2) }}</td>
                                    <td class="border border-gray-400 p-2 hidden md:table-cell">{{ number_format($item->nominal, 2) }}</td>
                                    <td class="border border-gray-400 p-2 hidden md:table-cell">{{ $item->created_by ?? 'GL' }}</td>
                                    <td class="border border-gray-400 p-2 hidden md:table-cell">{{ number_format($item->tagihan, 2) }}</td>
                                    <td class="border border-gray-400 p-2 hidden md:table-cell 
                                        @if ($item->statusPembayaran == 'LUNAS') bg-green-500 text-white
                                        @elseif($item->statusPembayaran == 'SEBAGIAN') bg-yellow-500 text-white
                                        @else bg-red-500 text-white @endif">
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
                </div> --}}
                <div class="overflow-hidden md:overflow-x-auto">
                    <table class="min-w-full table-fixed border-collapse border border-gray-400 text-[10px] sm:text-xs md:text-[15px]">
                        <thead>
                            <tr class="bg-gray-200">
                                <th class="border border-gray-400 px-1 py-2 ">ID</th>
                                <th class="border border-gray-400 px-1 py-2 ">Jenis Piutang</th>
                                <th class="border border-gray-400 px-1 py-2 ">Tanggal Transaksi</th>
                                <th class="border border-gray-400 px-1 py-2  text-center sm:hidden">Aksi</th>
                                <th class="border border-gray-400 px-1 py-2 hidden sm:table-cell">Jatuh Tempo</th>
                                <th class="border border-gray-400 px-1 py-2 hidden sm:table-cell">Tipe Pelanggan</th>
                                <th class="border border-gray-400 px-1 py-2 hidden sm:table-cell">Nama Pelanggan</th>
                                <th class="border border-gray-400 px-1 py-2 hidden sm:table-cell">Jenis Tagihan</th>
                                <th class="border border-gray-400 px-1 py-2 hidden sm:table-cell">DPP</th>
                                <th class="border border-gray-400 px-1 py-2 hidden sm:table-cell">PPN</th>
                                <th class="border border-gray-400 px-1 py-2 hidden sm:table-cell">PPH</th>
                                <th class="border border-gray-400 px-1 py-2 hidden sm:table-cell">Total Piutang</th>
                                <th class="border border-gray-400 px-1 py-2 hidden sm:table-cell">Dibuat Oleh</th>
                                <th class="border border-gray-400 px-1 py-2 hidden sm:table-cell">Sisa</th>
                                <th class="border border-gray-400 px-1 py-2 hidden sm:table-cell">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($piutang as $item)
                                <tr class="hover:bg-gray-100">
                                    <td class="border border-gray-400 px-1 py-2 underline text-blue-600 truncate">
                                        <a href="{{ route('printriwayatPiutang', ['nomor_invoice' => $item->no_invoice]) }}">
                                            {{ $item->no_invoice }}
                                        </a>
                                    </td>
                                    <td class="border border-gray-400 px-1 py-2 truncate">{{ $item->tipepiutang }}</td>
                                    <td class="border border-gray-400 px-1 py-2 truncate">{{ $item->tgltra }}</td>
                                    <td class="border border-gray-400 px-1 py-2 md:hidden     ">
                                        <div class="w-3 mx-auto">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48"><path fill="#2196f3" d="M17.1 5L14 8.1L29.9 24L14 39.9l3.1 3.1L36 24z"/></svg>
                                        </div>
                                    </td>
                                    <td class="border border-gray-400 px-1 py-2 hidden sm:table-cell">{{ $item->tgl_jatuh_tempo }}</td>
                                    <td class="border border-gray-400 px-1 py-2 hidden sm:table-cell">{{ $item->tipe_pelanggan }}</td>
                                    <td class="border border-gray-400 px-1 py-2 hidden sm:table-cell">{{ $item->customer_name }}</td>
                                    <td class="border border-gray-400 px-1 py-2 hidden sm:table-cell">{{ $item->jenistagihan }}</td>
                                    <td class="border border-gray-400 px-1 py-2 hidden sm:table-cell">{{ number_format($item->dpp, 2) }}</td>
                                    <td class="border border-gray-400 px-1 py-2 hidden sm:table-cell">{{ number_format($item->ppn, 2) }}</td>
                                    <td class="border border-gray-400 px-1 py-2 hidden sm:table-cell">{{ number_format($item->pph, 2) }}</td>
                                    <td class="border border-gray-400 px-1 py-2 hidden sm:table-cell">{{ number_format($item->nominal, 2) }}</td>
                                    <td class="border border-gray-400 px-1 py-2 hidden sm:table-cell">{{ $item->created_by ?? 'GL' }}</td>
                                    <td class="border border-gray-400 px-1 py-2 hidden sm:table-cell">{{ number_format($item->tagihan, 2) }}</td>
                                    <td class="border border-gray-400 px-1 py-2 hidden sm:table-cell 
                                        @if ($item->statusPembayaran == 'LUNAS') bg-green-500 text-white
                                        @elseif($item->statusPembayaran == 'SEBAGIAN') bg-yellow-500 text-white
                                        @else bg-red-500 text-white @endif">
                                        {{ $item->statusPembayaran }}
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="14" class="border border-gray-400 p-2 text-center text-gray-500">
                                        Data tidak ditemukan.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                
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
