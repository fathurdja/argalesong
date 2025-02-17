@extends('layouts.app')

@section('content')

    <div class="bg-gray-100 w-full p-5 mt-10">

        <!-- Bagian Pencarian dan Tombol Baru -->
        <div class="flex justify-between items-center mb-4 flex-wrap">
            <form id="filterForm" action="{{ route('customer.index') }}" method="GET" class="w-full max-w-sm flex space-x-4">
                <div class="">
                    <label for="idcompany" class="mr-2 text-xl text-gray-700 font-bold">Pilih Group:</label>
                    <input list="groupList" name="idcompany" id="idcompany"
                        class="border border-gray-300 py-2 px-4 rounded-md w-full sm:w-96" placeholder="Search group..."
                        value="{{ request('idcompany') }}">
                    <datalist id="groupList">
                        <option value="">-- Semua Group --</option>
                        @foreach ($perusahaan as $group)
                            <option value="{{ $group->company_id }}">
                                {{ $group->name }}
                            </option>
                        @endforeach
                    </datalist>
                </div>
            </form>
            <div class="flex justify-end w-full items-end">
                <a href="{{ route('customer.create') }}"
                    class="bg-green-500 justify-items-end text-white font-bold py-2 px-5 lg:py-2 lg:px-7 rounded-md">
                    Baru
                </a>
            </div>

        </div>
        <div>
            <h1 class="text-2xl font-bold mb-4">DAFTAR PELANGGAN</h1>
        </div>
        @if (isset($customer))
            <div class="bg-white border border-gray-400 p-4 rounded-md">
                <div class="flex justify-between items-center border-b border-gray-400 gap-4">
                    <div class="flex flex-col items-start justify-center md:flex-row">
                        <h2 class="text-xl font-bold">{{ $customer->id_Pelanggan }}</h2>
                        <h2 class="text-xl font-bold bg-slate-900">{{ $customer->name }}</h2>
                    </div>
                    <div class="flex space-x-2 ml-auto z-1">
                        <a href="{{ route('customer.edit', $customer->id) }}"><button
                                class="bg-green-700 text-black font-bold py-1 px-3 rounded-md">Edit Data</button></a>
                        <button class="bg-red-600 text-black font-bold py-1 px-3 rounded-md">Hapus</button>
                    </div>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <p><strong>Tipe Pelanggan :</strong> {{ $tipePelangganName }}</p>
                        <p><strong>NPWP :</strong> {{ $customer->npwp }}</p>
                        <p><strong>Alamat :</strong> {{ $customer->alamat }}</p>
                        <p><strong>E-mail :</strong> {{ $customer->email }}</p>
                        <p><strong>Whatsapp :</strong> {{ $customer->whatsapp }}</p>
                        <p><strong>Telepon :</strong> {{ $customer->telepon }}</p>
                        <p><strong>Fax :</strong> {{ $customer->fax }}</p>
                    </div>
                    <div>
                        <p><strong>% Sharing :</strong> {{ $customer->sharing }}%</p>
                        <p><strong>Kota :</strong> {{ $customer->kota }}</p>
                        <p><strong>Kode Pos :</strong> {{ $customer->kode_pos }}</p>
                    </div>
                </div>
            </div>
        @else
            @foreach ($daftarPelanggan as $pelanggan)
                <div class="bg-white shadow-sm p-4 rounded-md mb-5">
                    <div class="flex justify-between items-center border-b border-gray-600 opacity-95 gap-1">
                        <div class="gap-2 flex flex-col items-start justify-center  md:flex-row">
                            <h2 class="text-xl font-bold md:m-5">{{ $pelanggan->id_Pelanggan }}</h2>
                            <h2 class="text-lg md:text-xl font-bold md:m-5">{{ $pelanggan->name }}</h2>
                        </div>
                        <hr class="">
                        <div class="flex space-x-2 ml-auto">
                            <a href="{{ route('customer.edit', $pelanggan->id) }}"
                                class="p-2 bg-green-700 h-full text-white rounded-md">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24">
                                    <rect width="24" height="24" fill="none" />
                                    <g fill="none" stroke="#fff" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2">
                                        <path
                                            d="m16.475 5.408l2.117 2.117m-.756-3.982L12.109 9.27a2.1 2.1 0 0 0-.58 1.082L11 13l2.648-.53c.41-.082.786-.283 1.082-.579l5.727-5.727a1.853 1.853 0 1 0-2.621-2.621" />
                                        <path d="M19 15v3a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V7a2 2 0 0 1 2-2h3" />
                                    </g>
                                </svg>
                            </a>
                            
                            {{-- <button class="p-2 bg-red-600 text-white rounded-md">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </button> --}}
                            {{-- <form action="{{ route('customer.destroy', $pelanggan->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Apakah Anda yakin ingin menghapus pelanggan {{ $pelanggan->company->name }} ini?');"> --}}
                            <form action="{{ route('customer.destroy', $pelanggan->id) }}" method="POST" class="inline-block" onsubmit="return confirm('apakah anda ingin menghapus pelanggan {{ $pelanggan->name }}');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="p-2 bg-red-600 text-white rounded-md">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M6 18L18 6M6 6l12 12" />
                                    </svg>
                                </button>
                            </form>
                        </div>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-2">
                        <div>
                            <p><strong>Perusahaan :</strong> {{ $pelanggan->company->name }}</p>
                            <p><strong>Tipe Pelanggan :</strong> {{ $pelanggan->tipePelanggan->name }}</p>
                            <p><strong>NPWP :</strong> {{ $pelanggan->npwp }}</p>
                            <p><strong>Alamat :</strong> {{ $pelanggan->alamat }}</p>
                            <p><strong>E-mail :</strong> {{ $pelanggan->email }}</p>
                            <p><strong>Whatsapp :</strong> {{ $pelanggan->whatsapp }}</p>
                            <p><strong>Telepon :</strong> {{ $pelanggan->telepon }}</p>
                            <p><strong>Fax :</strong> {{ $pelanggan->fax }}</p>
                        </div>
                        <div>
                            <p><strong>% Sharing :</strong> {{ $pelanggan->sharing }}%</p>
                            <p><strong>Kota :</strong> {{ $pelanggan->kota }}</p>
                            <p><strong>Kode Pos :</strong> {{ $pelanggan->kode_pos }}</p>
                        </div>
                    </div>
                </div>
            @endforeach
            {{-- Paginate  --}}
            {{-- <div>{{ $daftarPelanggan->links() }}</div>  --}}
        @endif
    </div>

@endsection

@push('scripts')
    @vite('resources/js/test.js')
    <script>
        function konfirmasiDelete(event, form) {
        event.preventDefault(); // Mencegah submit otomatis

        // Hapus modal sebelumnya jika ada
        const existingModal = document.getElementById("confirmModal");
        if (existingModal) {
            existingModal.remove();
        }

        const modalHTML = `
            <div id="confirmModal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 px-6">
                <div class="bg-white p-6 rounded-md shadow-lg text-center">
                    <p class="text-lg font-semibold text-gray-800">
                        Apakah Anda yakin ingin menghapus pelanggan <strong>{{ $pelanggan->company->name }}</strong>?
                    </p>
                    <div class="mt-4 flex justify-center space-x-4">
                        <button id="confirmYes" class="px-4 py-2 bg-red-600 text-white rounded">Ya</button>
                        <button id="confirmNo" class="px-4 py-2 bg-gray-300 text-black rounded">Batal</button>
                    </div>
                </div>
            </div>
        `;

        document.body.insertAdjacentHTML("beforeend", modalHTML);

        document.getElementById("confirmYes").addEventListener("click", function () {
            form.submit(); // Submit form jika user memilih "Ya"
        });

        document.getElementById("confirmNo").addEventListener("click", function () {
            document.getElementById("confirmModal").remove(); // Hapus modal jika "Batal"
        });

        return false; // Mencegah submit form langsung
    }
    </script>
@endpush


@push('scripts')
    <script type="module">
        import {
            createIcons,
            icons
        } from 'lucide';
        createIcons({
            icons
        });
    </script>
@endpush
<script src="https://unpkg.com/lucide@latest"></script>
