@extends('layouts.app')

@section('content')
    <div class="container mx-auto ml-11 bg-white rounded-lg shadow-md">
        <div class="overflow-x-auto py-10 px-6">
            <!-- Form Filter -->
            <form method="GET" action="{{ route('riwayatPembayaran') }}" class="mb-6" id="filterForm">
                <label for="idcompany" class="mr-2 text-gray-700 font-bold">Pilih Perusahaan:</label>
                <input list="groupList" name="idcompany" id="idcompany" class="border border-gray-300 p-2 rounded-md w-96"
                    placeholder="Search group..." value="{{ request('idcompany') }}">
                <datalist id="groupList">
                    <option value="">-- Semua Group --</option>
                    @foreach ($perusahaan as $group)
                        <option value="{{ $group->company_id }}">{{ $group->name }}</option>
                    @endforeach
                </datalist>
            </form>

            <!-- Judul Halaman -->
            <h1 class="text-xl font-bold mb-4">Halaman Riwayat Pembayaran Piutang</h1>

            <!-- Tabel Data -->
            <table class="min-w-full table-fixed bg-white border border-gray-300 rounded-lg">
                <thead>
                    <tr class="bg-gray-200">
                        <th class="px-4 py-2 border border-gray-300 w-32">ID Pembayaran</th>
                        <th class="px-4 py-2 border border-gray-300 w-48">Nama Pelanggan</th>
                        <th class="px-4 py-2 border border-gray-300 w-40">Mode Pembayaran</th>
                        <th class="px-4 py-2 bo rder border-gray-300 w-48">Total Semua Piutang</th>
                        <th class="px-4 py-2 border border-gray-300 w-48">Nominal yang Dibayar</th>
                        <th class="px-4 py-2 border border-gray-300 w-48">Sisa</th>
                        <th class="px-4 py-2 border border-gray-300 w-32">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($riwayatPembayaran as $riwayat)
                        <tr class="hover:bg-gray-100">
                            <td class="px-4 py-2 border border-gray-300 truncate">{{ $riwayat->IDPembayaran }}</td>
                            <td class="px-4 py-2 border border-gray-300 truncate">{{ $riwayat->NamaPelanggan }}</td>
                            <td class="px-4 py-2 border border-gray-300 truncate">{{ $riwayat->ModePembayaran }}</td>
                            <td class="px-4 py-2 border border-gray-300 text-right truncate">
                                Rp{{ number_format($riwayat->TotalSemuaPiutang, 0, ',', '.') }}</td>
                            <td class="px-4 py-2 border border-gray-300 text-right truncate">
                                Rp{{ number_format($riwayat->NominalyangDibayar, 0, ',', '.') }}</td>
                            <td class="px-4 py-2 border border-gray-300 text-right truncate">
                                Rp{{ number_format($riwayat->Sisa, 0, ',', '.') }}
                            </td>
                            <td class="px-4 py-2 border border-gray-300 text-blue-500 hover:underline truncate">
                                <a href="#">Details</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-4 py-2 border border-gray-300 text-center text-gray-500">
                                Tidak ada data riwayat pembayaran.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            <!-- Pagination -->
            <div class="mt-4">
                {{ $riwayatPembayaran->appends(request()->query())->links() }}
            </div>
        </div>
    </div>
@endsection

@push('script')
@vite('resources/js/test.js')
@endpush
